<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserBasic as UserBasicResource;
use App\Http\Resources\UserBasicXl as UserBasicXlResource;
use App\User;
use App\Contact;
use App\ApplyedApplicant;
use DB;
use PDF2;
use Auth;
class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $user = Auth::user();

        $country_id = $request->country_id?$request->country_id:'';
        $job_id     = $request->job_id?$request->job_id:'';
        $search     = $request->search?$request->search:'';
        $t_by_admin = $request->t_by_admin?$request->t_by_admin:'';

        if($user->type == 1){
           $data = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $request->type)
                ->when($t_by_admin, function($q) use($t_by_admin){ 
                    if($t_by_admin == 1){
                        return $q->join('contacts','contacts.user_id','=','users.id')
                        ->where('contacts.t_by_admin',1);
                    }
                    else{
                        return $q->join('contacts','contacts.user_id','=','users.id')
                        ->whereNull('contacts.t_by_admin');
                    }
                })
                ->when($search, function($q) use($search){return $q
                    // ->where('users.name','like','%'.$search.'%')->orWhere('users.email','like','%'.$search.'%')->orWhere('users.phone','like','%'.$search.'%');})
                    ->where('users.name','like','%'.$search.'%');})
                ->when($country_id, function($q) use($country_id){return $q
                    ->join('country_applicants', 'users.id', '=', 'country_applicants.user_id')
                    ->where('country_applicants.country_id',$country_id);})
                ->when($job_id, function($q) use($job_id){return $q
                    ->join('desired_job_applicants', 'users.id', '=', 'desired_job_applicants.user_id')
                    ->where('desired_job_applicants.job_id',$job_id);})
                ->select('users.*')
                ->paginate(15);     
            return UserBasicResource::collection($data); 
        }
        elseif($user->type == 9){
            $contact = Contact::where('user_id',$user->id)->get()->first();
            $district_id = '';
            $subdistrict_id = '';
            $division_id = '';

            if($contact->designation_id == 1){
                $district_id = $contact->district_id;
            }
            elseif($contact->designation_id == 2){
                $subdistrict_id = $contact->subdistrict_id;
            }
            elseif($contact->designation_id == 3){
                $division_id = $contact->division_id;
            }


            $users_id = DB::table('addresses')
                ->when($division_id, function($q) use($division_id){return $q->where('addresses.div_id', $division_id);})
                ->when($district_id, function($q) use($district_id){return $q->where('addresses.dis_id', $district_id);})
                ->when($subdistrict_id, function($q) use($subdistrict_id){return $q->where('addresses.subdis_id', $subdistrict_id);})->where('addresses.type',1)->pluck('user_id');

            $data = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $request->type)
                    ->when($search, function($q) use($search){return $q
                    ->where('users.name','like','%'.$search.'%');})
                    ->when($country_id, function($q) use($country_id){return $q
                        ->join('country_applicants', 'users.id', '=', 'country_applicants.user_id')
                        ->where('country_applicants.country_id',$country_id);})
                    ->when($job_id, function($q) use($job_id){return $q
                        ->join('desired_job_applicants', 'users.id', '=', 'desired_job_applicants.user_id')
                        ->where('desired_job_applicants.job_id',$job_id);})
                    ->whereIn('users.id',$users_id)
                    ->select('users.*')
                    ->paginate(15);     
            return UserBasicResource::collection($data);
        }
        
    }

    public function getXlData(Request $request)
    {
        // return $request->all();
        
        $country_id = $request->country_id?$request->country_id:'';
        $job_id     = $request->job_id?$request->job_id:'';
        $search     = $request->search?$request->search:'';
        
        $data = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $request->type)
                ->when($search, function($q) use($search){return $q
                    ->where('users.name','like','%'.$search.'%')->orWhere('users.email','like','%'.$search.'%')->orWhere('users.phone','like','%'.$search.'%');})
                ->when($country_id, function($q) use($country_id){return $q
                    ->join('country_applicants', 'users.id', '=', 'country_applicants.user_id')
                    ->where('country_applicants.country_id',$country_id);})
                ->when($job_id, function($q) use($job_id){return $q
                    ->join('desired_job_applicants', 'users.id', '=', 'desired_job_applicants.user_id')
                    ->where('desired_job_applicants.job_id',$job_id);})
                ->select('users.*')
                ->paginate(15);     
        return UserBasicXlResource::collection($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPDFdata(Request $request)
    {
        $country_id  = $request->country_id?$request->country_id:'';
        $job_id      = $request->job_id?$request->job_id:'';
        $search      = $request->search?$request->search:'';
        $t_by_admin  = $request->t_by_admin?$request->t_by_admin:'';

        $post        = '';
        $district    = '';
        $subdistrict = '';
        $designation = '';
        $user = User::find($request->id);

        if($user->type == 1){
            $data = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $request->type)
                ->leftJoin('addresses','addresses.user_id','=','users.id')
                ->leftJoin('geo_districts','geo_districts.id','=','addresses.dis_id')->leftJoin('geo_upazilas','geo_upazilas.id','=','addresses.subdis_id')
                ->when($t_by_admin, function($q) use($t_by_admin){ 
                    if($t_by_admin == 1){
                        return $q->join('contacts','contacts.user_id','=','users.id')
                        ->where('contacts.t_by_admin',1);
                    }
                    else{
                        return $q->join('contacts','contacts.user_id','=','users.id')
                        ->whereNull('contacts.t_by_admin');
                    }
                })
                ->when($search, function($q) use($search){return $q
                    ->where('users.name','like','%'.$search.'%')->orWhere('users.email','like','%'.$search.'%')->orWhere('users.phone','like','%'.$search.'%');})
                ->when($country_id, function($q) use($country_id){return $q
                    ->join('country_applicants', 'users.id', '=', 'country_applicants.user_id')
                    ->where('country_applicants.country_id',$country_id);})
                ->when($job_id, function($q) use($job_id){return $q
                    ->join('desired_job_applicants', 'users.id', '=', 'desired_job_applicants.user_id')
                    ->where('desired_job_applicants.job_id',$job_id);})
                ->select('users.name','users.email','users.phone')->groupBy('users.id')
                ->paginate(15);     
            // $data2 = UserBasicXlResource::collection($data);
            $status = '';
            $user = $request->user;
            $pdf = PDF2::loadView('pdf.table',compact('data','status','user','post','district','subdistrict','designation'));
            $pdf->download('applicant.pdf');
        }
        elseif($user->type == 9){
            // return $request->type;
            $contact = Contact::where('user_id',$user->id)->get()->first();
            $district_id = '';
            $subdistrict_id = '';
            $district = '';
            $subdistrict = '';
            if($contact->designation_id == 1){
                $district_id = $contact->district_id;
                $designation = DB::table('designations')->where('id',1)->select('name as designation')->get()->first();
                $district = DB::table('geo_districts')->where('id',$district_id)->select('district_name_eng as district')->get()->first();
            }
            if($contact->designation_id == 2){
                $subdistrict_id = $contact->subdistrict_id;
                $designation = DB::table('designations')->where('id',2)->select('name as designation')->get()->first();
                $subdistrict = DB::table('geo_upazilas')->where('id',$subdistrict_id)->select('upazila_name_eng as subdistrict')->get()->first();
            }

            $users_id = DB::table('addresses')->when($district_id, function($q) use($district_id){return $q->where('addresses.dis_id', $district_id);})
                ->when($subdistrict_id, function($q) use($subdistrict_id){return $q->where('addresses.subdis_id', $subdistrict_id);})->where('addresses.type',1)->pluck('user_id');

            $data = User::where('users.type', $request->type)
                ->whereIn('users.id',$users_id)
                ->when($search, function($q) use($search){return $q
                    ->where('users.name','like','%'.$search.'%')->orWhere('users.email','like','%'.$search.'%')->orWhere('users.phone','like','%'.$search.'%');})
                ->when($country_id, function($q) use($country_id){return $q
                    ->join('country_applicants', 'users.id', '=', 'country_applicants.user_id')
                    ->where('country_applicants.country_id',$country_id);})
                ->when($job_id, function($q) use($job_id){return $q
                    ->join('desired_job_applicants', 'users.id', '=', 'desired_job_applicants.user_id')
                    ->where('desired_job_applicants.job_id',$job_id);})
                ->select('users.name','users.email','users.phone')
                ->get();    
            // $data2 = UserBasicXlResource::collection($data);
            $status = '';
            $user = $request->user;
            $pdf = PDF2::loadView('pdf.table',compact('data','status','user','post','district','subdistrict','designation'));
            $pdf->download('applicant.pdf');
        }
    }

    public function getAppliedPDFdata(Request $request)
    {
        $post_id = $request->post_id?$request->post_id:'';
        $post = '';
        if($post_id){
            $post = DB::table('posts')->where('id',$post_id)->get()->first();
        }
        $status  = $request->status?$request->status:'';
        $name    = $request->name?$request->name:'';
        $auth_id = $request->auth_id;
        $district = '';
        $subdistrict = '';
        $designation = '';
        $data = ApplyedApplicant::when($post_id, function($q) use($post_id){return $q->where('post_id' , $post_id);})
                ->when($status && $status!=111 , function($q) use($status){return $q->where('status' , $status);})
                ->when($name, function($q) use($name){return $q->join('users', 'applyed_applicants.applicant_id', '=', 'users.id')
                    ->where('users.name','like','%'.$name.'%');})
                    // ->where('agency_id',$auth_id)
                    ->join('users', 'applyed_applicants.applicant_id', '=', 'users.id')
                    ->orderBy('applyed_applicants.id','DESC')
                    ->select('users.name','users.email','users.phone')
                    ->paginate(15); 
        $user = $request->user;
        $pdf = PDF2::loadView('pdf.table',compact('data','status','user','post','district','subdistrict','designation'));
        $pdf->download('applicant.pdf');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function applicantTraining(Request $request)
    {
        $contact = Contact::where('user_id',$request->id)->first();

        return json_decode($contact->trainings);
    }
}

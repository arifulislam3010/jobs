<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\district;
use App\subdistrict;
use App\union;
use App\division;
use App\TrainingCenter;
use App\DesiredJob;
use App\Country;
use App\Language;
use App\Board;
use App\PassingYear;
use App\Designation;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\DesireJob as DesireJobResource;
use App\Http\Resources\DesireJobTree as DesireJobTreeResource;
use App\Http\Resources\CountryTree as CountryTreeResource;
use Excel;
use App\User;
use App\Contact;
use App\RoleUser;
use App\SocialLink;
use App\TrainingCenterType;

use DB;

use Modules\FrontEnd\Entities\Post;

class OthersController extends Controller
{
    public function getSocialLink(){
        return SocialLink::find(1);
    }

    public function changeSocialLink(Request $request){
        $link = SocialLink::find(1);
        $link->phone    = $request->input('phone');
        $link->facebook = $request->input('facebook');
        $link->youtube  = $request->input('youtube');
        $link->update();
        return $link;
    }
    
    
    public function trainingType()
    {
        return TrainingCenterType::select('id','name')->get();
    }
    
    public function designation()
    {
        return Designation::select('id','name')->get();
    }

    public function guide()
    {
        return Post::where('type',10)->where('deleted_at',null)->orderBy('id','DESC')->get();
    }

    public function language()
    {
        return Language::where('deleted_at',null)->orderBy('name','ASC')->select('id','name')->get();
    }

    public function country()
    {
        return Country::where('deleted_at',null)->orderBy('country_name','ASC')->select('id','country_name')->get();
    }

    public function agency()
    {
        return User::orderBy('name','ASC')->where('type',3)->select('id','name')->get();
    }

    public function agencyTree()
    {
        return User::orderBy('name','ASC')->where('type',3)->select('id','name as label')->get();
    }

    public function country2()
    {
        $data = Country::where('deleted_at',null)->get();
        return CountryResource::collection($data);
    }

    public function countryTree()
    {
        $data = Country::where('deleted_at',null)->get();
        return CountryTreeResource::collection($data);
    }

    public function division()
    {
        return division::where('deleted_at',null)->orderBy('division_name_eng','ASC')->select('id','division_name_eng','division_name_bng')->get();
    }

    public function districtById($id)
    {
        return district::where('deleted_at',null)->where('geo_division_id',$id)->orderBy('district_name_eng','ASC')->select('id','district_name_eng','district_name_bng')->get();
    }

    public function district()
    {
        return district::where('deleted_at',null)->orderBy('district_name_eng','ASC')->select('id','district_name_eng')->get();
    }
    
    public function subdistrict($id)
    {
        return subdistrict::where('deleted_at',null)->where('geo_district_id',$id)->orderBy('upazila_name_eng','ASC')->select('id','upazila_name_eng')->get();
    }

    public function union($id)
    {
        return union::where('deleted_at',null)->where('geo_upazila_id',$id)->orderBy('union_name_eng','ASC')->select('id','union_name_eng')->get();
    }

    public function trainingCenter()
    {
        return DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id',4)
            ->orderBy('users.name','ASC')->select('id','name')->get();
       // return DB::table('role_users')->where('role_id',3)->select('user_id')->get();
        // return TrainingCenter::orderBy('name','ASC')->get();
    }

    public function desiredJob()
    {

        return $data = DesiredJob::where('deleted_at',null)->orderBy('name','ASC')->get();
        // return DesireJobResource::collection($data);
    }

    public function desiredJobTree()
    {

        $data = DesiredJob::where('deleted_at',null)->orderBy('id','ASC')->get();
        return DesireJobTreeResource::collection($data);
    }

    public function passingYear()
    {
        return PassingYear::where('deleted_at',null)->orderBy('year','ASC')->get();
    }
    
    public function board()
    {
        return Board::where('deleted_at',null)->orderBy('name','ASC')->get();
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->type == 'divisions'){
            $division = new division;
            $division->division_name_eng = $request->name;
            $division->save();
            return division::where('id',$division->id)->select('id','division_name_eng as name')->get()->first();
        }
        elseif($request->type == 'districts'){
            $district = new district;
            $district->district_name_eng = $request->name;
            $district->geo_division_id   = $request->parent_id;
            $district->save();
            return district::join('geo_divisions','geo_divisions.id','=','geo_districts.geo_division_id')->orderBy('geo_districts.district_name_eng','ASC')->select('geo_districts.id','geo_districts.district_name_eng as name','geo_districts.geo_division_id as parent_id','geo_divisions.division_name_eng as parent_name')
               ->where('geo_districts.id',$district->id)->get()->first();
        }
        elseif($request->type == 'subdistricts'){
            $subdistrict = new subdistrict;
            $subdistrict->upazila_name_eng  = $request->name;
            $subdistrict->geo_district_id   = $request->parent_id;
            $subdistrict->save();
            return subdistrict::join('geo_districts','geo_districts.id','=','geo_upazilas.geo_district_id')->orderBy('geo_upazilas.upazila_name_eng','ASC')->select('geo_upazilas.id','geo_upazilas.upazila_name_eng as name','geo_upazilas.geo_district_id as parent_id','geo_districts.district_name_eng as parent_name')
               ->where('geo_upazilas.id',$subdistrict->id)->get()->first();
        }
        elseif($request->type == 'unions'){
            $union = new union;
            $union->union_name_eng   = $request->name;
            $union->geo_upazila_id   = $request->parent_id;
            $union->save();
            return union::join('geo_upazilas','geo_upazilas.id','=','geo_unions.geo_upazila_id')->orderBy('geo_unions.union_name_eng','ASC')->select('geo_upazilas.id','geo_unions.union_name_eng as name','geo_unions.geo_upazila_id as parent_id','geo_upazilas.upazila_name_eng as parent_name')
                ->where('geo_unions.id',$union->id)->get()->first();
        }
        elseif($request->type == 'jobs'){
            $job = new DesiredJob;
            $job->name   = $request->name;
            $job->save();
            return $job;
        }
        elseif($request->type == 'countries'){
            $country = new Country;
            $country->country_name   = $request->name;
            $country->save();
            return Country::where('id',$country->id)->select('id','country_name as name')->get()->first();
        }
        elseif($request->type == 'languages'){
            $job = new Language;
            $job->name   = $request->name;
            $job->save();
            return $job;
        } 
        elseif($request->type == 'boards'){
            $job = new Board;
            $job->name   = $request->name;
            $job->save();
            return $job;
        } 
        elseif($request->type == 'degrees'){
            $job = new PassingYear;
            $job->year   = $request->name;
            $job->save();
            return PassingYear::where('id',$job->id)->select('id','year as name')->get()->first();
        } 
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->all();
        $limit = $request->limit;
        if($request->type == 'divisions'){
            return division::where('deleted_at',null)->orderBy('division_name_eng','ASC')->select('id','division_name_eng as name')->paginate($limit);
        }
        elseif($request->type == 'districts'){
            return district::join('geo_divisions','geo_divisions.id','=','geo_districts.geo_division_id')->orderBy('geo_districts.district_name_eng','ASC')->select('geo_districts.id','geo_districts.district_name_eng as name','geo_districts.geo_division_id as parent_id','geo_divisions.division_name_eng as parent_name')
               ->where('geo_districts.deleted_at',null)->paginate($limit);
        }
        elseif($request->type == 'subdistricts'){
            return subdistrict::join('geo_districts','geo_districts.id','=','geo_upazilas.geo_district_id')->orderBy('geo_upazilas.upazila_name_eng','ASC')->select('geo_upazilas.id','geo_upazilas.upazila_name_eng as name','geo_upazilas.geo_district_id as parent_id','geo_districts.district_name_eng as parent_name')
               ->where('geo_upazilas.deleted_at',null)->paginate($limit);
        }
        elseif($request->type == 'unions'){
            return union::join('geo_upazilas','geo_upazilas.id','=','geo_unions.geo_upazila_id')->orderBy('geo_unions.union_name_eng','ASC')->select('geo_unions.id','geo_unions.union_name_eng as name','geo_unions.geo_upazila_id as parent_id','geo_upazilas.upazila_name_eng as parent_name')
               ->where('geo_unions.deleted_at',null)->paginate($limit);
        }
        elseif($request->type == 'jobs'){
            return DesiredJob::where('deleted_at',null)->orderBy('name','ASC')->paginate($limit);
        }
        elseif($request->type == 'countries'){
            return Country::where('deleted_at',null)->orderBy('country_name','ASC')->select('id','country_name as name')->paginate($limit);
        }
        elseif($request->type == 'languages'){
            return Language::where('deleted_at',null)->orderBy('name','ASC')->paginate($limit);
        }
        elseif($request->type == 'boards'){
            return Board::where('deleted_at',null)->orderBy('name','ASC')->paginate($limit);
        }
        elseif($request->type == 'degrees'){
            return PassingYear::where('deleted_at',null)->orderBy('year','ASC')->select('id','year as name')->paginate($limit);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        if($request->type == 'divisions'){
            $division = division::find($id);
            $division->deleted_at = now();
            $division->update();
            return "ok";
        }
        elseif($request->type == 'districts'){
            $district = district::find($id);
            $district->deleted_at = now();
            $district->update();
            return "ok";
        }
        elseif($request->type == 'subdistricts'){
            $subdistrict = subdistrict::find($id);
            $subdistrict->deleted_at = now();
            $subdistrict->update();
            return "ok";
        }
        elseif($request->type == 'unions'){
            $union = union::find($id);
            $union->deleted_at = now();
            $union->save();
            return "ok";
        }
        elseif($request->type == 'jobs'){
            $job = DesiredJob::find($id);
            $job->deleted_at = now();
            $job->save();
            return "ok";
        }
        elseif($request->type == 'countries'){
            $job = Country::find($id);
            $job->deleted_at = now();
            $job->save();
            return "ok";
        }
        elseif($request->type == 'languages'){
            $job = Language::find($id);
            $job->deleted_at = now();
            $job->save();
            return "ok";
        } 
        elseif($request->type == 'boards'){
            $job = Board::find($id);
            $job->deleted_at = now();
            $job->save();
            return "ok";
        } 
        elseif($request->type == 'degrees'){
            $job = PassingYear::find($id);
            $job->deleted_at = now();
            $job->update();
            return "ok";
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        if($request->type == 'divisions'){
            $division = division::find($id);
            $division->division_name_eng = $request->name;
            $division->update();
            return division::where('id',$id)->select('id','division_name_eng as name')->get()->first();
        }
        elseif($request->type == 'districts'){
            $district = district::find($id);
            $district->district_name_eng = $request->name;
            $district->geo_division_id   = $request->parent_id;
            $district->update();
            return district::join('geo_divisions','geo_divisions.id','=','geo_districts.geo_division_id')->orderBy('geo_districts.district_name_eng','ASC')->select('geo_districts.id','geo_districts.district_name_eng as name','geo_districts.geo_division_id as parent_id','geo_divisions.division_name_eng as parent_name')
               ->where('geo_districts.id',$id)->get()->first();
        }
        elseif($request->type == 'subdistricts'){
            $subdistrict = subdistrict::find($id);
            $subdistrict->upazila_name_eng  = $request->name;
            $subdistrict->geo_district_id   = $request->parent_id;
            $subdistrict->update();

            return subdistrict::join('geo_districts','geo_districts.id','=','geo_upazilas.geo_district_id')->orderBy('geo_upazilas.upazila_name_eng','ASC')->select('geo_upazilas.id','geo_upazilas.upazila_name_eng as name','geo_upazilas.geo_district_id as parent_id','geo_districts.district_name_eng as parent_name')
               ->where('geo_upazilas.id',$subdistrict->id)->get()->first();
        }
        elseif($request->type == 'unions'){
            // return $request->all();
            $union = union::find($id);
            $union->union_name_eng   = $request->name;
            $union->geo_upazila_id   = $request->parent_id;
            $union->update();
            return union::join('geo_upazilas','geo_upazilas.id','=','geo_unions.geo_upazila_id')->orderBy('geo_unions.union_name_eng','ASC')->select('geo_upazilas.id','geo_unions.union_name_eng as name','geo_unions.geo_upazila_id as parent_id','geo_upazilas.upazila_name_eng as parent_name')
                ->where('geo_unions.id',$union->id)->get()->first();
        }
        elseif($request->type == 'jobs'){
            $job = DesiredJob::find($id);
            $job->name = $request->name;
            $job->update();
            return $job;
        }
        elseif($request->type == 'countries'){
            $country = Country::find($id);
            $country->country_name = $request->name;
            $country->update();
            return Country::where('id',$country->id)->select('id','country_name as name')->get()->first();
        }
        elseif($request->type == 'languages'){
            $job = Language::find($id);
            $job->name = $request->name;
            $job->update();
            return $job;
        }
        elseif($request->type == 'boards'){
            $job = Board::find($id);
            $job->name = $request->name;
            $job->update();
            return $job;
        }
        elseif($request->type == 'degrees'){
            $job = PassingYear::find($id);
            $job->year = $request->name;
            $job->update();
            return PassingYear::where('id',$country->id)->select('id','year as name')->get()->first();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadExcel()
    {
        return view('upload-excel');
    }

    public function uploadExcelStore(Request $request)
    {
        return 111;
        //dd($request->all());
        $data = Excel::load($request['excel_file'])->get();
        
        //return $phone[0];
        foreach ($data[0] as $key => $value) {
            $phone_number = explode(",", $value->contact_no);

            if(!empty($phone_number)){
                $contact_no = preg_replace('/^\+?88|\|88|\D/', '', ($phone_number[0]));
            }
            else
                $contact_no = null;

            $user = new User();
            $user->name = $value->name;
            $user->phone = $contact_no;
            $user->password = '$2y$10$/yJOBCVl8SCwzZU30N2E/ePAYxT3lHo9FzkE5Xq03bYW.lUoEMX4e';
            $user->save();

            if($user){
                $address = $value->address;

                $contact = new Contact();
                $contact->user_id = $user->id;
                $contact->registration_number = $value->rel_no;
                $contact->all_phone_no = $value->contact_no;
                $contact->address = '[{"address":"'.$address.'"}]';
                $contact->save();

                $roleuser = new RoleUser();
                $roleuser->user_id = $user->id;
                $roleuser->role_id = 3;
                $roleuser->save();
            }
        }
        return 'Save';
        die();
    }

    public function uploadExcelStoreAreawise(Request $request)
    {
        //return 1;
        $data = Excel::load($request['excel_file'])->get();

        //return strlen($data[0]->nid_no);

        foreach ($data as $key => $value) {
            
            $user = new User();
            $user->name = $value->name;
            $user->phone = '0'.$value->mobile_no;
            $user->password = '$2y$10$/yJOBCVl8SCwzZU30N2E/ePAYxT3lHo9FzkE5Xq03bYW.lUoEMX4e';
            $user->save();

            if($user){
                $address = $value->address;

                $contact = new Contact();
                $contact->user_id           = $user->id;
                $contact->guardian_name     = $value->father_name;
                $contact->address           = '[{"address":"'.$address.'"}]';
                $contact->union_name        = $value->union_name;
                $contact->division_id       = 3;
                $contact->district_id       = 34;
                $contact->subdistrict_id    = 264;

                $contact->skill_details     = '[{"name":"'.$value->skill.'"}]';

                $contact->educations        = '[{"degree":"'. $value->education .'","p_year":"","institute":"","board":"","subject":"","grade":""}]';

                if(strlen($value->nid_no) < 12){
                    $contact->personal = '{"name":null,"father_name":null,"mother_name":null,"spouse_name":null,"nid":null,"nationality":"Bangladeshi","country":null,"marital_status":"Married","sex":null,"religion":null,"weight":null,"height":null,"job":[],"passport_no":'.$value->nid_no.',"passport_date":null,"birth_date":null,"no_son":null,"no_daughter":null}';
                }
                else if(strlen($value->nid_no) >= 12){
                    $contact->personal = '{"name":null,"father_name":null,"mother_name":null,"spouse_name":null,"nid":'.$value->nid_no.',"nationality":"Bangladeshi","country":null,"marital_status":"Married","sex":null,"religion":null,"weight":null,"height":null,"job":[],"passport_no":null,"passport_date":null,"birth_date":null,"no_son":null,"no_daughter":null}';
                }
                else{
                    $contact->personal = '{"name":null,"father_name":null,"mother_name":null,"spouse_name":null,"nid":null,"nationality":"Bangladeshi","country":null,"marital_status":"Married","sex":null,"religion":null,"weight":null,"height":null,"job":[],"passport_no":null,"passport_date":null,"birth_date":null,"no_son":null,"no_daughter":null}';
                }

                
                $contact->save();

                $roleuser = new RoleUser();
                $roleuser->user_id = $user->id;
                $roleuser->role_id = 6;
                $roleuser->save();
            }
        }
        return 'Save';
        die();
    }
}

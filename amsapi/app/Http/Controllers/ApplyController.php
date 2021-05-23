<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use Auth;
use App;
use View;
use PDF2;
use App\User;
use App\ApplyedApplicant;
use App\Favourite;
use App\Education;
use App\Contact;
use App\Experience;
use App\Training;
use App\Address;
use App\Http\Resources\ApplyedApplicant as ApplyedApplicantResource;
use App\Http\Resources\Cv as CvResource;
use App\Http\Resources\GetJobPost as GetJobPostResource;
class ApplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addFavourite($id){
        $user = Auth::user();
        $post = DB::table('posts')->where('id',$id)->get()->first();

        $data = [
          'post_id'=>$post->id,
          'agency_id'=>$post->author_id,
          'applicant_id'=>$user->id,
        ];
        Favourite::insert($data);
        return response()->json(['ok'=>'ok'],201);
    }

    public function removeFavourite($id){
        $user = Auth::user();
        $post = Favourite::where('post_id',$id)->where('applicant_id',$user->id)->delete();
        return response()->json(['ok'=>'ok'],200);
    }

    public function favouriteList(){
        $user = Auth::user();
        $post = Favourite::join('posts','favourites.post_id','posts.id')->join('users','favourites.agency_id','users.id')->where('favourites.applicant_id',$user->id)->select('users.name as agency','users.slug as agency_slug','posts.headline as post','posts.slug as post_slug')->get();
        // return response()->json(['ok'=>'ok'],200);
        return $post;
    }
    

    public function apply($id)
    {
        $user = Auth::user();
        $post = DB::table('posts')->where('id',$id)->get()->first();
        $job_id      = $post->job_id;
        $country_id  = $post->country_id;
        $language_id = $post->language_id;
        $experience  = $post->experience;

        $a_language = DB::table('language_apllicants')->where('user_id',$user->id)->where('lanuage_id',$language_id)->get()->first();
        $a_country = DB::table('country_applicants')->where('user_id',$user->id)->where('country_id',$country_id)->get()->first();
        $a_job = DB::table('desired_job_applicants')->where('user_id',$user->id)->where('job_id',$job_id)->get()->first();

        $experience_y = DB::table('experiences')->where('user_id',$user->id)->sum('duration_y');
        $experience_m = DB::table('experiences')->where('user_id',$user->id)->sum('duration_m');

        $job_error = '';
        $experience_error = '';
        $language_error = '';
        $country_error = '';
        $error = 0;

        if($job_id){
            $job = DB::table('desired_jobs')->where('id',$job_id)->get()->first();
            if($a_job){
               if($job_id != $a_job->job_id){
                    $error++;
                    $job_error = $job->name;
                } 
            }
            else{
                $error++;
                $job_error = $job->name;
            }
        }

        if($country_id){
            $country = DB::table('apps_countries')->where('id',$country_id)->get()->first();
            if($a_country){
               if($country_id != $a_country->country_id){
                    $error++;
                    $country_error = $country->country_name;
                } 
            }
            else{
                $error++;
                $country_error = $country->country_name;
            }
            
        }

        if($language_id){
            $language = DB::table('languages')->where('id',$language_id)->get()->first();
            if($a_language){
                if($language_id != $a_language->lanuage_id){
                    $error++;
                    $language_error = $language->name;
                }
            }
            else{
                $error++;
                $language_error = $language->name;
            }
        }

        if($experience){
            if(($experience_y*12+$experience_m) < ($experience*12)){
                $error++;
                $experience_error = $experience;
            }
        }

        // return $experience_y*12+$experience_m;
        if($error){
            return response()->json([
                'job_error'      => $job_error,
                'country_error'  => $country_error,
                'language_error' => $language_error,
                'experience_error'     => $experience_error
            ],400);
        }
        else{
            $data = [
                'post_id'=>$post->id,
                'agency_id'=>$post->author_id,
                'applicant_id'=>$user->id, 
                'status'=>1,
                'created_at'=>date("Y-m-d")
            ];

            ApplyedApplicant::insert($data);

            return response()->json(['ok'=>'ok'],201);
        }
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkApply($slug)
    {
        $post = DB::table('posts')->where('slug',$slug)->get()->first();
        $check_applyed = ApplyedApplicant::where('post_id',$post->id)->where('applicant_id',Auth::user()->id)->get()->first();

        $check_favourite = Favourite::where('post_id',$post->id)->where('applicant_id',Auth::user()->id)->get()->first();

        $applyed = 0;
        $favourite = 0;
        
        if($check_applyed){
            $applyed = 1;
        }
        else{
            $applyed = 0;
        }

        if($check_favourite){
           $favourite = 1;
        }
        else{
            $favourite = 0;
        }

        return response()->json(['applyed'=>$applyed, 'favourite'=>$favourite],200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getApplicant(Request $request)
    {
        $post_id = $request->post_id?$request->post_id:'';
        $status  = $request->status?$request->status:'';
        $name    = $request->name?$request->name:'';
        if(Auth::user()->type == 1)
        {
            $data = ApplyedApplicant::when($post_id, function($q) use($post_id){return $q->where('post_id' , $post_id);})
                    ->when($status && $status!=111 , function($q) use($status){return $q->where('status' , $status);})
                    ->when($name, function($q) use($name){return $q->join('users', 'applyed_applicants.applicant_id', '=', 'users.id')
                        ->where('users.name','like','%'.$name.'%')
                        ->orWhere('users.email',$name)->orWhere('users.phone',$name)->select('users.id as user_id','applyed_applicants.*');})
                        ->orderBy('id','DESC')
                        ->paginate(15);
        }
        elseif(Auth::user()->type == 9)
        {
            $data = ApplyedApplicant::when($post_id, function($q) use($post_id){return $q->where('post_id' , $post_id);})
                    ->when($status && $status!=111 , function($q) use($status){return $q->where('status' , $status);})
                    ->when($name, function($q) use($name){return $q->join('users', 'applyed_applicants.applicant_id', '=', 'users.id')
                        ->where('users.name','like','%'.$name.'%')->select('users.id as user_id','applyed_applicants.*');})
                        ->orderBy('id','DESC')
                        ->paginate(15);
        }
        elseif(Auth::user()->type == 3){
            $data = ApplyedApplicant::when($post_id, function($q) use($post_id){return $q->where('post_id' , $post_id);})
                ->when($status && $status!=111 , function($q) use($status){return $q->where('status' , $status);})
                ->when($name, function($q) use($name){return $q->join('users', 'applyed_applicants.applicant_id', '=', 'users.id')
                    ->where('users.name','like','%'.$name.'%')->select('users.id as user_id','applyed_applicants.*');})
                    ->where('agency_id',Auth::user()->id)
                    ->orderBy('id','DESC')
                    ->paginate(15); 
        }
        elseif(Auth::user()->type == 6){
            $data = ApplyedApplicant::when($status && $status!=111 , function($q) use($status)
                        {return $q->where('status' , $status);})
                        ->where('applicant_id',Auth::user()->id)
                        ->orderBy('id','DESC')
                        ->paginate(15); 
        }
        

        return ApplyedApplicantResource::collection($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getJobPost(Request $request)
    {
       // return $request->all();
        $data = '';
        $job_id      = ($request->has('job_id'))?$request['job_id']:null;
        $country_id  = ($request->has('country_id'))?$request['country_id']:null;
        if(Auth::user()->type == 1){
            $data = DB::table('posts')->where('deleted_at',null)->where('type',1)->when($job_id,function($q) use($job_id){return $q->where('job_id', $job_id);})->when($country_id,function($q) use($country_id){return $q->where('country_id', $country_id);})->orderBy('id','DESC')->paginate(8);
        }
        elseif(Auth::user()->type == 9){
            $contact = Contact::where('user_id',Auth::user()->id)->get()->first();
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

            $data = DB::table('posts')->where('posts.deleted_at',null)->where('posts.type',1)->when($job_id,function($q) use($job_id){return $q->where('posts.job_id', $job_id);})->when($country_id,function($q) use($country_id){return $q->where('country_id', $country_id);})
            ->when($division_id,function($q) use($division_id){return $q->join('contacts','contacts.user_id','=','posts.author_id')->where('contacts.division_id', $division_id);})
            ->when($district_id,function($q) use($district_id){return $q->join('contacts','contacts.user_id','=','posts.author_id')->where('contacts.district_id', $district_id);})
            ->when($subdistrict_id,function($q) use($subdistrict_id){return $q->join('contacts','contacts.user_id','=','posts.author_id')->where('contacts.subdistrict_id', $subdistrict_id);})
            ->orderBy('posts.id','DESC')->select('posts.*')->paginate(8);
        }
        elseif(Auth::user()->type == 3){
            $data = DB::table('posts')->where('deleted_at',null)->where('author_id',Auth::user()->id)->where('type',1)->when($job_id,function($q) use($job_id){return $q->where('job_id', $job_id);})->when($country_id,function($q) use($country_id){return $q->where('country_id', $country_id);})->orderBy('id','DESC')->paginate(8);
        }

        return GetJobPostResource::collection($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApplicant(Request $request)
    {
        $applicant = ApplyedApplicant::find($request->id);
        $applicant->status = $request->status;
        $applicant->update();
        return new ApplyedApplicantResource($applicant);
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
    public function test()
    {
        $file= public_path('test.pdf');


        $headers = array(
              'Content-Type: application/xlsx',
            );

       

        // return Response::download((public_path('CV.pdf'), 'filename.pdf', $headers);

        // return response()->download(public_path('CV.pdf'));

        $data = DB::table('users')->get()->take(5)->toArray();

        $customer_array[] = array('name');
         foreach($data as $customer)
         {
          $customer_array[] = array(
           'name'   => $customer->name
          );
         }

         // return $customer_array;
         $data = Excel::create('Customer Data', function($excel) use ($customer_array){
          // $excel->setTitle('Customer Data');
          $excel->sheet('Customer Data', function($sheet) use ($customer_array){
           $sheet->fromArray($customer_array, null, 'A1', false, false);
          });
         });

         return response()->download($data, 'filename.xlsx', $headers);
    }

    public function testxyz(){
      $data = 'https://www.w3schools.com/howto/img_avatar.png';
        $user = User::where('id',1219)->select('name','email','phone')->get()->first();
        $contact = Contact::where('user_id',1219)->select('nid','address2','address3')->get()->first();
        $educations = Education::where('user_id',1219)->get();
        $experiences = Experience::where('user_id',1219)->get();
        $trainings = Training::join('users','trainings.training_center_id','users.id')
        ->select('trainings.*','users.name')->get();
        // return $address = Address::all();
        // return view('pdf.cv',compact('data','user','contact','educations','experiences','trainings'));
        $pdf = PDF2::loadView('pdf.cv',compact('data','user','contact','educations','experiences','trainings'));
        $pdf->download('invoice.pdf');
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        $data = 'https://www.w3schools.com/howto/img_avatar.png';
        $pdf = \PDF::loadView('pdf.test',compact('data'));
        
        // return "ok";
    }

    public function summaryApplicant(){
        $applicant_id = Auth::user()->id;
        $total_applcation = ApplyedApplicant::where('applicant_id',$applicant_id)->get()->count();
        $pending_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',1)->get()->count();
        $sorted_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',2)->get()->count();
        $selected_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',3)->get()->count();
        $favourite = Favourite::where('applicant_id',$applicant_id)->get()->count();

        return response()->json([
            'total' => $total_applcation,
            'pending' => $pending_application,
            'sorted' => $sorted_application,
            'selected' => $selected_application,
            'favourite' => $favourite
        ],200);
    }

    public function testPdf(){
      // return view('pdf.test',compact('data'))
      // $pdf = PDF2::loadView('pdf.table');
      // return $pdf->stream();
      // return base_path('resources/fonts/').'SolaimanLipi_22-02-2012.ttf';
      // $mpdf = new \Mpdf\Mpdf([
      //   'default_font_size'=>16,
      //   'default_font' => 'solaimanLipi'
      // ]);
      // $mpdf->WriteHTML('<h1>Hello ডোমেইন</h1>');
      
      // $mpdf->Output();
         // return $educations = Education::where('user_id',1219)->get();
      // $pdf = App::make('dompdf.wrapper');
      // $pdf->loadHTML('<h1>Test</h1>');
      // return $pdf->stream();
        $data = 'https://www.w3schools.com/howto/img_avatar.png';
        // return view('pdf.test',compact('data'));
        $pdf = PDF2::loadView('pdf.test',compact('data'));
        return $pdf->stream();

        $user = User::where('id',1219)->select('name','email','phone')->get()->first();
        $contact = Contact::where('user_id',1219)->select('nid','address2','address3','languages')->get()->first();
        $educations = Education::where('user_id',1219)->get();
        $experiences = Experience::where('user_id',1219)->get();
        $trainings = Training::join('users','trainings.training_center_id','users.id')
        ->select('trainings.*','users.name')->get();
        $country_id = DB::table('country_applicants')->where('user_id',1219)->get()->pluck('country_id');
        $job_id     = DB::table('desired_job_applicants')->where('user_id',1219)->get()->pluck('job_id');
        $countries  = DB::table('apps_countries')->whereIn('id',$country_id)->get();
        $jobs       = DB::table('desired_jobs')->whereIn('id',$job_id)->get();
        $pdf = PDF2::loadView('pdf.cv',compact('data','user','contact','educations','experiences','trainings','countries','jobs'));
        return $pdf->stream();
        // $pdf->download('invoice.pdf');
    }

    public function getCv(Request $request){
      if($request->user_id){
        if(Auth::user()->id == 1 || Auth::user()->type == 9){
          $user_id = $request->user_id;
        }
      }
      else{
        $user_id = Auth::user()->id;
      }
      
      $user = User::find($user_id);

      return new CvResource($user);
      
    }

    public function downloadCv($id){
        $data = 'https://www.w3schools.com/howto/img_avatar.png';
        $user = User::where('id',$id)->select('name','email','phone')->get()->first();
        $contact = Contact::where('user_id',$id)->select('nid','address2','address3','languages','image')->get()->first();
        $educations = Education::where('user_id',$id)->get();
        $experiences = Experience::where('user_id',$id)->get();
        $trainings = Training::join('users','trainings.training_center_id','users.id')->where('trainings.user_id',$id)
        ->select('trainings.*','users.name')->get();

        $total_experiences = Experience::where('user_id',$id)->get()->count();
        $total_trainings = Training::join('users','trainings.training_center_id','users.id')->where('trainings.user_id',$id)
        ->select('trainings.*','users.name')->get()->count();
        $total = $total_experiences + $total_trainings;
        // $country_id = DB::table('country_applicants')->where('user_id',$id)->get()->pluck('country_id');
        // $job_id     = DB::table('desired_job_applicants')->where('user_id',$id)->get()->pluck('job_id');
        // $countries  = DB::table('apps_countries')->whereIn('id',$country_id)->get();
        // $jobs       = DB::table('desired_jobs')->whereIn('id',$job_id)->get();
        $pdf = PDF2::loadView('pdf.test2',compact('data','user','contact','educations','experiences','trainings','total'));
        $pdf->download('cv.pdf');
    }
}
 
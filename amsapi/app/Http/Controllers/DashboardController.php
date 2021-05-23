<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF2;
use Auth;
use App\Contact;
use App\User;

class DashboardController extends Controller
{
    public function summaryAgency(){
      $user = Auth::user();

      $total_post = DB::table('posts')->where('type',1)->where('author_id',$user->id)->where('deleted_at',null)->get()->count();
      $total_applied_applicant = DB::table('applyed_applicants')->where('agency_id',$user->id)->get()->count();
      $total_migrated = DB::table('applyed_applicants')->where('agency_id',$user->id)->where('status',4)->get()->count();
      return response()->json([
          'total_post'              => $total_post,
          'total_applied_applicant' => $total_applied_applicant,
          'total_migrated'          => $total_migrated
      ],200);
    }
   	public function summaryAdmin(){

      if(Auth::user()->type == 1){
        $total_post = DB::table('posts')->where('type',1)->where('deleted_at',null)->get()->count();
        $total_applicant = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',6)->get()->count();
        $total_agency = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',3)->get()->count();
        $total_training_center = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',4)->get()->count();
        $total_financial_organization = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',5)->get()->count();
        $total_embassy = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',7)->get()->count();
        $total_migrated = DB::table('applyed_applicants')->where('status',4)->get()->count();
      }

      if(Auth::user()->type == 9){
        $contact = Contact::where('user_id',Auth::user()->id)->get()->first();
        $district_id = '';
        $subdistrict_id = '';
        $division_id = '';

        if($contact->designation_id == 1){
          $district_id = $contact->district_id;
        }
        if($contact->designation_id == 2){
          $subdistrict_id = $contact->subdistrict_id;
        }
        if($contact->designation_id == 3){
          $division_id = $contact->division_id;
        }
          

        $users_id = DB::table('addresses')->when($division_id, function($q) use($division_id){return $q->where('addresses.div_id', $division_id);})
          ->when($district_id, function($q) use($district_id){return $q->where('addresses.dis_id', $district_id);})
                ->when($subdistrict_id, function($q) use($subdistrict_id){return $q->where('addresses.subdis_id', $subdistrict_id);})->where('addresses.type',1)->pluck('user_id');

        $total_applicant = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', 6) ->whereIn('users.id',$users_id)->select('users.*')->get()->count();

        $total_agency = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',3)
        ->when($division_id,function($q) use($division_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.division_id', $division_id);})
        ->when($district_id,function($q) use($district_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.district_id', $district_id);})
        ->when($subdistrict_id,function($q) use($subdistrict_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.subdistrict_id', $subdistrict_id);})->get()->count();

        $agency_id = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',3)
        ->when($division_id,function($q) use($division_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.division_id', $division_id);})
        ->when($district_id,function($q) use($district_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.district_id', $district_id);})
        ->when($subdistrict_id,function($q) use($subdistrict_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.subdistrict_id', $subdistrict_id);})->pluck('users.id');

        $total_migrated = DB::table('applyed_applicants')->whereIn('agency_id',$agency_id)->where('status',4)->get()->count();

        $total_post = 0;
        $total_training_center = 0;
        $total_financial_organization = 0;
        $total_embassy = 0;
      }
   		
   		// $applicant_id = Auth::user()->id;
     //    $total_applcation = ApplyedApplicant::where('applicant_id',$applicant_id)->get()->count();
     //    $pending_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',1)->get()->count();
     //    $sorted_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',2)->get()->count();
     //    $selected_application = ApplyedApplicant::where('applicant_id',$applicant_id)->where('status',3)->get()->count();
     //    $favourite = Favourite::where('applicant_id',$applicant_id)->get()->count();

        return response()->json([
            'total_post' => $total_post,
            'total_applicant' => $total_applicant,
            'total_agency' => $total_agency,
            'total_training_center' => $total_training_center,
            'total_financial_organization' => $total_financial_organization,
            'total_embassy' => $total_embassy,
            'total_migrated' => $total_migrated
        ],200);
   	}

   	public function getMigrateApplicant(Request $request){
   		$agency_id = $request->agency_id?$request->agency_id:'';
   		$country_id = $request->country_id?$request->country_id:'';

      if(Auth::user()->type == 3){
        $agency_id = Auth::user()->id;
        $data = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

        $count = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->get()->count();
      }
      if(Auth::user()->type == 1){
        $data = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

        $count = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->get()->count();
      }
      if(Auth::user()->type == 9){
        $contact = Contact::where('user_id',Auth::user()->id)->get()->first();
        $district_id = '';
        $subdistrict_id = '';

        if($contact->designation_id == 1){
            $district_id = $contact->district_id;
        }
        if($contact->designation_id == 2){
            $subdistrict_id = $contact->subdistrict_id;
        }

        $agency_id = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',3)->when($district_id,function($q) use($district_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.district_id', $district_id);})
        ->when($subdistrict_id,function($q) use($subdistrict_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.subdistrict_id', $subdistrict_id);})->pluck('users.id');

        $data = DB::table('applyed_applicants')->whereIn('agency_id',$agency_id)->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

        $count = DB::table('applyed_applicants')->whereIn('agency_id',$agency_id)->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->get()->count();
      }

   		return response()->json(['data'=>$data,'count'=>$count],200);
   	}

    public function statisticsAdmin(Request $request){

      $div_id = $request->div_id?$request->div_id:'';
      $dis_id = $request->dis_id?$request->dis_id:'';
      $subdis_id = $request->subdis_id?$request->subdis_id:'';
      $end_date = $request->end_date?$request->end_date:'';
      $start_date = $request->start_date?$request->start_date:'';

       $applied_applicant = DB::table('applyed_applicants')->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();

       $migrate_applicant = DB::table('applyed_applicants')->where('status',4)->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();


      $unskilled_applicant = DB::table('applyed_applicants')->join('contacts','contacts.user_id','=','applyed_applicants.applicant_id')->where('contacts.languages',null)->where('contacts.trainings',null)->
        where('contacts.experiences',null)->select('contacts.*')->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();

      $skilled_applicant = $applied_applicant - $unskilled_applicant;

      $others = DB::table('applyed_applicants')->join('contacts','contacts.user_id','=','applyed_applicants.applicant_id')->where('contacts.gender','অন্যান্য')->select('contacts.*')->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();
      $female = DB::table('applyed_applicants')->join('contacts','contacts.user_id','=','applyed_applicants.applicant_id')->where('contacts.gender','মহিলা')->select('contacts.*')->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();
      $male = DB::table('applyed_applicants')->join('contacts','contacts.user_id','=','applyed_applicants.applicant_id')->where('contacts.gender','পুরুষ')->select('contacts.*')->leftJoin('addresses','addresses.user_id','=','applyed_applicants.applicant_id')->where('addresses.type',1)
       ->when($div_id , function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id , function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})->get()->count();
      
       return response()->json([
          'applied_applicant'   => $applied_applicant,
          'migrate_applicant'   => $migrate_applicant,
          'skilled_applicant'   => $skilled_applicant,
          'unskilled_applicant' => $unskilled_applicant,
          'others'              => $others,
          'female'              => $female,
          'male'                => $male
        ],200);
    }

    public function getUpazillaStatistics(Request $request){

      $div_id = $request->div_id?$request->div_id:'';
      $dis_id = $request->dis_id?$request->dis_id:'';
      $subdis_id = $request->subdis_id?$request->subdis_id:'';
      $end_date = $request->end_date?$request->end_date:'';
      $start_date = $request->start_date?$request->start_date:'';

      $table = DB::table('applyed_applicants')->join('contacts','contacts.user_id','=','applyed_applicants.applicant_id')
       ->join('addresses','addresses.user_id','=','contacts.user_id')
       ->join('geo_upazilas','geo_upazilas.id','=','addresses.subdis_id')
       ->select('geo_upazilas.upazila_name_eng',
        DB::raw("SUM(CASE WHEN (contacts.experiences IS NULL AND contacts.languages IS NULL AND contacts.trainings IS NULL) THEN 1 ELSE 0 END) AS 'unskilled_applicant'"),
        DB::raw("SUM(CASE WHEN (contacts.experiences IS NOT NULL OR contacts.languages IS NOT NULL OR contacts.trainings IS NOT NULL) THEN 1 ELSE 0 END) AS 'skilled_applicant'"),
        DB::raw("SUM(CASE WHEN (applyed_applicants.status = 4) THEN 1 ELSE 0 END) AS 'migrate_applicant'"),
        DB::raw("SUM(CASE WHEN (applyed_applicants.status IS NOT NULL) THEN 1 ELSE 0 END) AS 'applied_applicant'")
       )
      ->where('addresses.type',1)
      ->when($div_id, function($q) use($div_id){return $q->where('addresses.div_id', $div_id);})
      ->when($dis_id, function($q) use($dis_id){return $q->where('addresses.dis_id', $dis_id);})
      ->when($subdis_id , function($q) use($subdis_id){return $q->where('addresses.subdis_id', $subdis_id);})
      ->when($end_date && $start_date, function($q) use($end_date,$start_date){return $q->whereBetween('applyed_applicants.created_at', [$start_date, $end_date]);})
      ->groupBy('geo_upazilas.id')->get();

      return $table;
    }

   	public function getMigratePDFdata(Request $request){
   		$agency_id = $request->agency_id?$request->agency_id:'';
   		$country_id = $request->country_id?$request->country_id:'';
      $user = $request->user;
      if($request->type == 3){
        $agency_id = $request->user_id;
        $data = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

          // return $data;
         $pdf = PDF2::loadView('pdf.migrate',compact('data','user'));
          $pdf->download('applicant.pdf');
      }
      if($request->type == 1){
        $data = DB::table('applyed_applicants')->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($agency_id , function($q) use($agency_id){return $q->where('posts.author_id', $agency_id);})
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

          // return $data;
         $pdf = PDF2::loadView('pdf.migrate',compact('data','user'));
          $pdf->download('applicant.pdf');
      }
      if($request->type == 9){
        $contact = Contact::where('user_id',$request->user_id)->get()->first();
        $district_id = '';
        $subdistrict_id = '';

        if($contact->designation_id == 1){
            $district_id = $contact->district_id;
        }
        if($contact->designation_id == 2){
            $subdistrict_id = $contact->subdistrict_id;
        }

        $agency_id = DB::table('users')->join('role_users','users.id','=','role_users.user_id')->where('role_users.role_id',3)->when($district_id,function($q) use($district_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.district_id', $district_id);})
        ->when($subdistrict_id,function($q) use($subdistrict_id){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.subdistrict_id', $subdistrict_id);})->pluck('users.id');

        $data = DB::table('applyed_applicants')->whereIn('agency_id',$agency_id)->where('applyed_applicants.status',4)
          ->join('users as agency','agency.id','=','applyed_applicants.agency_id')
          ->join('users as applicant','applicant.id','=','applyed_applicants.applicant_id')
          ->join('posts','posts.id','=','applyed_applicants.post_id')
          ->when($country_id , function($q) use($country_id){return $q->where('posts.country_id', $country_id);})
          ->select('agency.name as agency_name','agency.slug as agency_slug','applicant.name as applicant_name','posts.headline as post_name','posts.slug as post_slug')->paginate(15);

          // return $data;
         $pdf = PDF2::loadView('pdf.migrate',compact('data','user'));
          $pdf->download('applicant.pdf');
      }
   		
   	}
}

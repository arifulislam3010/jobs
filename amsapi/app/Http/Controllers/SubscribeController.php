<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SubscribeAgency;
use App\SubscribeCountry;
use App\SubscribeJob;
use App\SubscribeLanguage;
use Auth;
use DB;

class SubscribeController extends Controller
{
    public function subscribe(Request $request){
    	$applicant_id = Auth::user()->id;
    	$subscriber = SubscribeAgency::where('agency_id',$request->agency_id)->where('applicant_id',$applicant_id)->get()->first();
    	if($subscriber){
    		SubscribeAgency::where('agency_id',$request->agency_id)->where('applicant_id',$applicant_id)->delete();
    		return response()->json(['subscribe'=>0],200);
    	}
    	else{
    		$data = [[ 
    			'applicant_id' => $applicant_id,
    			'agency_id'    => $request->agency_id
    		]];
    		SubscribeAgency::insert($data);
    		return response()->json(['subscribe'=>1],200);
    	}
    }

    public function getAgency(Request $request){
        $user = Auth::user();
        $subscribe_agencies = SubscribeAgency::where('applicant_id',$user->id)->join('users','users.id','=','subscribe_agencies.agency_id')->orderBy('subscribe_agencies.id','DESC')->select('users.name as agency_name','subscribe_agencies.id')->paginate(10);
        $subscribe_id = SubscribeAgency::where('applicant_id',$user->id)->pluck('agency_id');
        $agencies = User::where('type',3)->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
        return response()->json(['subscribe_agencies'=>$subscribe_agencies,'agencies'=>$agencies],200);
    }

    public function getCountry(Request $request){
        $user = Auth::user();
        $subscribe_countries = SubscribeCountry::where('applicant_id',$user->id)->join('apps_countries','apps_countries.id','=','subscribe_countries.country_id')->orderBy('subscribe_countries.id','DESC')->select('apps_countries.country_name as country_name','subscribe_countries.id')->paginate(10);
        $subscribe_id = SubscribeCountry::where('applicant_id',$user->id)->pluck('country_id');
        $countries = DB::table('apps_countries')->whereNotIn('id',$subscribe_id)->select('id','country_name as label')->get();
        return response()->json(['subscribe_countries'=>$subscribe_countries,'countries'=>$countries],200);
    }

    public function getJob(Request $request){
        $user = Auth::user();
        $subscribe_jobs = SubscribeJob::where('applicant_id',$user->id)->join('desired_jobs','desired_jobs.id','=','subscribe_jobs.job_id')->orderBy('subscribe_jobs.id','DESC')->select('desired_jobs.name as job_name','subscribe_jobs.id')->paginate(10);
        $subscribe_id = SubscribeJob::where('applicant_id',$user->id)->pluck('job_id');
        $jobs = DB::table('desired_jobs')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
        return response()->json(['subscribe_jobs'=>$subscribe_jobs,'jobs'=>$jobs],200);
    }

    public function getLanguage(Request $request){
        $user = Auth::user();
        $subscribe_languages = SubscribeLanguage::where('applicant_id',$user->id)->join('languages','languages.id','=','subscribe_languages.language_id')->orderBy('subscribe_languages.id','DESC')->select('languages.name as language_name','subscribe_languages.id')->paginate(10);
        $subscribe_id = SubscribeLanguage::where('applicant_id',$user->id)->pluck('language_id');
        $languages = DB::table('languages')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
        return response()->json(['subscribe_languages'=>$subscribe_languages,'languages'=>$languages],200);
    }

    public function store(Request $request){
        $user = Auth::user();
        $type = $request->type;

        if($type == 'agency'){
            $data = [];
            foreach ($request->agency as $key => $value) {
                $temp = [
                    'applicant_id'      =>  $user->id,
                    'agency_id'         =>  $value
                ];
                array_push($data,$temp);
            }
            SubscribeAgency::insert($data);

            $subscribe_agencies = SubscribeAgency::where('applicant_id',$user->id)->join('users','users.id','=','subscribe_agencies.agency_id')->orderBy('subscribe_agencies.id','DESC')->select('users.name as agency_name','subscribe_agencies.id')->paginate(10);
            $subscribe_id = SubscribeAgency::where('applicant_id',$user->id)->pluck('agency_id');
            $agencies = User::where('type',3)->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['subscribe_agencies'=>$subscribe_agencies,'agencies'=>$agencies],200);
        }

        elseif($type == 'country'){
            $data = [];
            foreach ($request->country as $key => $value) {
                $temp = [
                    'applicant_id'      =>  $user->id,
                    'country_id'        =>  $value
                ];
                array_push($data,$temp);
            }
            SubscribeCountry::insert($data);

            $subscribe_countries = SubscribeCountry::where('applicant_id',$user->id)->join('apps_countries','apps_countries.id','=','subscribe_countries.country_id')->orderBy('subscribe_countries.id','DESC')->select('apps_countries.country_name as country_name','subscribe_countries.id')->paginate(10);
            $subscribe_id = SubscribeCountry::where('applicant_id',$user->id)->pluck('country_id');
            $countries = DB::table('apps_countries')->whereNotIn('id',$subscribe_id)->select('id','country_name as label')->get();
            return response()->json(['subscribe_countries'=>$subscribe_countries,'countries'=>$countries],200);
        }
        elseif($type == 'job'){
            $data = [];
            foreach ($request->job as $key => $value) {
                $temp = [
                    'applicant_id'  =>  $user->id,
                    'job_id'        =>  $value
                ];
                array_push($data,$temp);
            }
            SubscribeJob::insert($data);

            $subscribe_jobs = SubscribeJob::where('applicant_id',$user->id)->join('desired_jobs','desired_jobs.id','=','subscribe_jobs.job_id')->orderBy('subscribe_jobs.id','DESC')->select('desired_jobs.name as job_name','subscribe_jobs.id')->paginate(10);
            $subscribe_id = SubscribeJob::where('applicant_id',$user->id)->pluck('job_id');
            $jobs = DB::table('desired_jobs')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['subscribe_jobs'=>$subscribe_jobs,'jobs'=>$jobs],200);
        }
        elseif($type == 'language'){
            $data = [];
            foreach ($request->language as $key => $value) {
                $temp = [
                    'applicant_id'      =>  $user->id,
                    'language_id'       =>  $value
                ];
                array_push($data,$temp);
            }
            SubscribeLanguage::insert($data);

            $subscribe_languages = SubscribeLanguage::where('applicant_id',$user->id)->join('languages','languages.id','=','subscribe_languages.language_id')->orderBy('subscribe_languages.id','DESC')->select('languages.name as language_name','subscribe_languages.id')->paginate(10);
            $subscribe_id = SubscribeLanguage::where('applicant_id',$user->id)->pluck('language_id');
            $languages = DB::table('languages')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['subscribe_languages'=>$subscribe_languages,'languages'=>$languages],200);
        }
    }
    public function destroy(Request $request){
        // return $request->all();
        $user = Auth::user();
        $type = $request->type;

        if($type == 'agency'){

            $subscribe_agency = SubscribeAgency::find($request->id);
            $subscribe_agency->delete();

            $subscribe_id = SubscribeAgency::where('applicant_id',$user->id)->pluck('agency_id');
            $agencies = User::where('type',3)->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['agencies'=>$agencies],200);
        }
        elseif($type == 'country'){

            $subscribe_country = SubscribeCountry::find($request->id);
            $subscribe_country->delete();

            $subscribe_id = SubscribeCountry::where('applicant_id',$user->id)->pluck('country_id');
            $countries = DB::table('apps_countries')->whereNotIn('id',$subscribe_id)->select('id','country_name as label')->get();
            return response()->json(['countries'=>$countries],200);
        }
        elseif($type == 'job'){

            $subscribe_job = SubscribeJob::find($request->id);
            $subscribe_job->delete();

            $subscribe_id = SubscribeJob::where('applicant_id',$user->id)->pluck('job_id');
            $jobs = DB::table('desired_jobs')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['jobs'=>$jobs],200);
        }
        elseif($type == 'country'){

            $subscribe_language = SubscribeLanguage::find($request->id);
            $subscribe_language->delete();

            $subscribe_id = SubscribeLanguage::where('applicant_id',$user->id)->pluck('language_id');
            $languages = DB::table('apps_countries')->whereNotIn('id',$subscribe_id)->select('id','name as label')->get();
            return response()->json(['languages'=>$languages],200);
        }
    }
    
    
}

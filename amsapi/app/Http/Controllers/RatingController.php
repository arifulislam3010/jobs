<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RatingRiview;
use App\SubscribeAgency;
use Auth;
use DB;
use App\Http\Resources\RatingReview as RatingReviewResource;

class RatingController extends Controller
{
    public function rate(Request $request){
    	if(RatingRiview::where('agency_id',$request->agency_id)->where('reviewer_id',$request->reviewer_id)->get()->first()){
    		$data = RatingRiview::where('agency_id',$request->agency_id)->where('reviewer_id',$request->reviewer_id)->get()->first();
    		$data->rating = $request->rating;
    		$data->comment = $request->comment;
    		$data->update();
    	}
    	else{
    		$rating = new RatingRiview;
	    	$rating->agency_id = $request->agency_id;
	    	$rating->reviewer_id = $request->reviewer_id;
	    	$rating->rating = $request->rating;
	    	$rating->comment = $request->comment;
	    	$rating->parent_comment_id = $request->parent_comment_id;
	    	$rating->save();
    	}
    }

    public function reply(Request $request){
    		RatingRiview::where('parent_comment_id',$request->parent_comment_id)->delete();
    	    $rating = new RatingRiview;
	    	$rating->agency_id = $request->agency_id;
	    	$rating->reviewer_id = $request->reviewer_id;
	    	$rating->comment = $request->comment;
	    	$rating->parent_comment_id = $request->parent_comment_id;
	    	$rating->save();
    }

    public function getReview(Request $request){
    	// return $request->all();
    	$data = RatingRiview::where('agency_id',$request->agency_id)->where('parent_comment_id',null)->whereNotNull('comment')->paginate(10);

    	return RatingReviewResource::collection($data);
    	// return $data;
    }

    public function getUserRating(Request $request){
        $user_id = Auth::user()->id;
    	$data = RatingRiview::where('reviewer_id',$user_id)->where('agency_id',$request->agency_id)->where('parent_comment_id',null)->get()->first();
        $subscrber = SubscribeAgency::where('agency_id',$request->agency_id)->where('applicant_id',$user_id)->get()->first();
        if($subscrber){
            $subscribe = 1;
        }
        else{
            $subscribe = 0;
        }

        if($data){
            $check = 1;
        }
        else{
            $check = 0;
        }

        $one  = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('rating','>=',1)->where('rating','<',2)->get()->count();
        $two  = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('rating','>=',2)->where('rating','<',3)->get()->count();
        $three  = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('rating','>=',3)->where('rating','<',4)->get()->count();
        $four  = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('rating','>=',4)->where('rating','<',5)->get()->count();
        $five  = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('rating','>=',5)->get()->count();
        $total = DB::table('rating_riviews')->where('agency_id',$request->agency_id)->where('parent_comment_id',null)->get()->count();

        return response()->json(['subscribe'=>$subscribe,'data'=>$data,'five'=>$five ,'one'=>$one ,'two'=>$two ,'three'=>$three ,'four'=>$four,'total'=>$total,'check'=>$check],200);
    }
}

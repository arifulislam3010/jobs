<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\User;;
use App\Jobs\SendReminderEmail;
use Carbon\Carbon;
use Modules\Post\Entities\Post;
use Mail;
use DB;
use PDF2;
class TestController extends Controller
{
    public function testJob(){
        $pdf = PDF2::loadView('pdf.test2');
        return $pdf->stream();
        return DB::table('role_users')->where('role_id',6)->pluck('user_id');
        return User::all()->pluck('id');
    	// $emails = User::whereNotNull('email')->pluck('email');
    	// return $emails;

    	$user = User::find(1219);
    	$post = Post::find(118);

    	$data = [
    		'user' => $user,
    		'post' => $post
    	];

    	// return $data['post']->id;

    	// return $post;


    	// $data = ['user' => 1219,
    	// 	'post_id' => 11];
    	// return $data['user_id'];
        SendReminderEmail::dispatch($data)
                ->delay(now()->addSeconds(10));
    	// return "ok";
    }

    private function sendConfirmationEmail($user,$code){
        Mail::send('Email.activation',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Activate your account");
        });
    }
}

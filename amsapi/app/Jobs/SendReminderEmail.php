<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\User;
use Modules\Post\Entities\Post;

class SendReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user;
    public $post;

    public function __construct($user)
    {
        $this->user = $user['user'];
        $this->post = $user['post'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post =  $this->post;
        $user = $this->user;
        // $user = User::find(1219);

        Mail::send('Email.subscriber',[
            'user' => $user,
            'post' => $post,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name");
        });
    }
}

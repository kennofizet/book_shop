<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EmailContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $linkweb;
    public $address;
    public $nameweb;
    public $email;
    public $title;
    public $template;
    public $template_name;
    public $content;
    public $email_admin;
    public $user_id;
    public $user_name;

    public function __construct($name,$linkweb,$address,$nameweb,$email,$title,$template,$template_name,$content,$email_admin,$user_id,$user_name)
    {
        $this->name = $name;
        $this->linkweb = $linkweb;
        $this->address = $address;
        $this->nameweb = $nameweb;
        $this->email = $email;
        $this->title = $title;
        $this->template = $template;
        $this->template_name = $template_name;
        $this->content = $content;
        $this->email_admin = $email_admin;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('key_press_email_contact')->allow(999999)->every(1)->then(function () {
            $email_to = $this->email_admin;
            $email_to_template_name = $this->template_name;
            $email_to_template_content = $this->content;
            $title = $this->title;
            Mail::send($this->template, 
            array(
                'name'=>$this->name,
                'linkweb'=>$this->linkweb,
                'address' => $this->address,
                'nameweb' => $this->nameweb,
                'title' => $this->title,
                'email'=> $this->email,
                'content'=> $this->content,
                'user_id'=> $this->user_id,
                'user_name'=> $this->user_name,
            ), function($message)use($email_to,$email_to_template_name,$title){
                $message->to($email_to, $email_to_template_name)->subject($title);
            });

        }, function () {
            return $this->release(999999);
        });
    }
}

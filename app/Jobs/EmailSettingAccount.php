<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EmailSettingAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $linkweb;
    public $address;
    public $nameweb;
    public $email;
    public $content;
    public $template;
    public $template_name;
    public $template_content;
    public $newpassword;

    public function __construct($name,$linkweb,$address,$nameweb,$email,$content,$template,$template_name,$template_content,$newpassword)
    {
        $this->name = $name;
        $this->linkweb = $linkweb;
        $this->address = $address;
        $this->nameweb = $nameweb;
        $this->email = $email;
        $this->content = $content;
        $this->template = $template;
        $this->template_name = $template_name;
        $this->template_content = $template_content;
        $this->newpassword = $newpassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('key_press_email_setting_account')->allow(999999)->every(1)->then(function () {
            $email_to = $this->email;
            $email_to_template_name = $this->template_name;
            $email_to_template_content = $this->template_content;
            Mail::send($this->template, 
            array(
                'name'=>$this->name,
                'linkweb'=>$this->linkweb,
                'address' => $this->address,
                'nameweb' => $this->nameweb,
                'email'=> $this->email,
                'content'=> $this->content,
                'newpassword'=> $this->newpassword,
            ), function($message)use($email_to,$email_to_template_name,$email_to_template_content){
                $message->to($email_to, $email_to_template_name)->subject($email_to_template_content);
            });

        }, function () {
            return $this->release(999999);
        });
    }
}

<?php

namespace App\Jobs;

use App\Notifications\SendMailToUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;
class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5;
    public $title;
    public $content;
    public $users;
    /**
     * Create a new job instance.
     */

     public function __construct($title, $content, $users)
     {
         $this->title = $title;
         $this->content = $content;
         $this->users = $users;
     }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send($this->users, new SendMailToUser($this->title, $this->content));
    }
}

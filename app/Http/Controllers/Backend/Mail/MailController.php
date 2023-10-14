<?php

namespace App\Http\Controllers\Backend\Mail;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Models\User;
use App\Notifications\SendMailToUser;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class MailController extends Controller
{
    use Notifiable;
    public function index(){
        $users = User::all();
        return Inertia::render('Backend/Mail/Index',[
            'users' => $users,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $title = $request->title;
        $content = $request->content;
        $requestUsers = $request->users;
        $users = User::whereIn('email', $requestUsers)->get();

        SendMail::dispatch($title, $content, $users);
        // Notification::send($users, new SendMailToUser($title, $content));
        return redirect()->route('mail.index');
    }

    public function sendSub(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $users = User::where('is_subscribed', 1)->get();

        $title = $request->title;
        $content = $request->content;
        SendMail::dispatch($title, $content, $users);
        // // Notification::send($users, new SendMailToUser($title, $content));
        return redirect()->route('mail.index');

    }
}

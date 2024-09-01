<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\NewsLetterSubscribers;
use App\Mail\VerifySubscriptionEmail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $email = $request->email;
        $email = base64_decode($email);
        if(NewsLetterSubscribers::where('email', $email)->count() > 0)
        {
            return 'exists';
        }

        NewsLetterSubscribers::create([
           'email' => $email
        ]);

        Mail::to($email)->send(new VerifySubscriptionEmail($email));
        return 'true';
    }

    public function verify(Request $request)
    {
        $email = base64_decode($request->token);
        NewsLetterSubscribers::where('email', $email)->update([
            'verify_status' => 'yes'
        ]);

        return redirect('subscription-verified')->with('email-subscription-status', 'yes');
    }

    public function verified()
    {
        if(!Session::has('email-subscription-status'))
        {
            return redirect('/');
        }else{
            return view('frontend.subscription-verified');
        }
    }
}

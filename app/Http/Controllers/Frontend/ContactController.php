<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\Contact;
use App\BackendModel\ContactInfo;
use App\BackendModel\EmailNotification;
use App\BackendModel\Feedback;
use App\Mail\FeedbackAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::first();
        return view('frontend.contact', compact('contactInfo'));
    }

    public function submit(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
           'message' => 'required',
        ]);

        $data = $request->except('_token');
        $data['user_id'] = Auth::id();
        Feedback::create($data);

        if(EmailNotification::first()->feedback_alert != null)
        {
            Mail::to(EmailNotification::first()->feedback_alert)->send(new FeedbackAlert($data));
        }

        return redirect()->back()->with('feedback-thanks', 'Thanks for your feedback! We will be in touch with you shortly');
    }
}

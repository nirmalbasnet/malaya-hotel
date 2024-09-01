<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\EmailNotification;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationEmailsController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Notification Emails'))
            return redirect('admin/access-denied');

        if(EmailNotification::count() > 0)
        {
            $data = EmailNotification::first();
            return view('admin.notification-emails.index', compact('data'));
        }else{
            return view('admin.notification-emails.index');
        }
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Notification Emails'))
            return redirect('admin/access-denied');

        $this->validate($request, [
           'destination_review_alert' => 'nullable|email',
           'booking_alert' => 'nullable|email',
        ]);

        $data = $request->except('_token');
        $data['created_by'] = Auth::guard('admin')->id();
        EmailNotification::create($data);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Notification Emails'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'destination_review_alert' => 'nullable|email',
            'booking_alert' => 'nullable|email',
            'inquiry_alert' => 'nullable|email',
            'feedback_alert' => 'nullable|email',
        ]);

        $data = $request->except('_token');
        $data['created_by'] = Auth::guard('admin')->id();
        EmailNotification::find($id)->update($data);
        return redirect()->back();
    }
}

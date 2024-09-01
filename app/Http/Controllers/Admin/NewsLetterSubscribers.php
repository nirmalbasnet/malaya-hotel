<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsLetterSubscribers extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Newsletter Subscribers'))
            return redirect('admin/access-denied');

        $subscribers = \App\BackendModel\NewsLetterSubscribers::orderBy('id', 'DESC')->paginate('10');
        return view('admin.subscribers.list', compact('subscribers'));
    }

    public function changeStatus($id)
    {
        if(!RoleManager::checkHasRoles('Newsletter Subscribers'))
            return redirect('admin/access-denied');

        if(\App\BackendModel\NewsLetterSubscribers::find($id)->status == 'active')
        {
            \App\BackendModel\NewsLetterSubscribers::find($id)->update([
                'status' => 'suspended'
            ]);
        } else {
            \App\BackendModel\NewsLetterSubscribers::find($id)->update([
                'status' => 'active'
            ]);
        }
        return redirect()->back()->with('message', 'Status successfully changed.');
    }

    public function deleteSubscribers($id)
    {
        if(!RoleManager::checkHasRoles('Newsletter Subscribers'))
            return redirect('admin/access-denied');

        \App\BackendModel\NewsLetterSubscribers::find($id)->delete();
        return redirect()->back()->with('message', 'Subscriber successfully deleted.');

    }
}

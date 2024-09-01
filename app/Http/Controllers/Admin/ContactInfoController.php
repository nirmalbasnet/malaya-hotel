<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\ContactInfo;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactInfoController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Contact Info'))
            return redirect('admin/access-denied');

        $contactInfo = ContactInfo::first();
        return view('admin.contact-info.list', compact('contactInfo'));
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Contact Info'))
            return redirect('admin/access-denied');

        $data = $request->except('_token');
        $data['created_by'] = Auth::guard('admin')->user()->id;
        ContactInfo::create($data);
        return redirect()->back()->with('message', 'Contact information successfully created');
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Contact Info'))
            return redirect('admin/access-denied');

        $data = $request->except('_token');
        $data['created_by'] = Auth::guard('admin')->user()->id;
        ContactInfo::find($id)->update($data);
        return redirect()->back()->with('message', 'Contact information successfully updated');
    }
}

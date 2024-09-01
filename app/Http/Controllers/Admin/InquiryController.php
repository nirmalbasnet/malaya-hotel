<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Contact;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('User Inquiries'))
            return redirect('admin/access-denied');

        if(Contact::where('read_status', 'unseen')->count() > 0)
        {
            Contact::where('read_status', 'unseen')->update([
                'read_status' => 'seen',
                'seen_by' => Auth::guard('admin')->user()->id
            ]);
        }
        $data = Contact::orderBy('id', 'DESC')->paginate('10');
        return view('admin.inquiry.list', compact('data'));
    }
}

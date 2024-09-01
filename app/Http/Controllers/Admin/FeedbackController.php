<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Contact;
use App\BackendModel\Feedback;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Feedbacks'))
            return redirect('admin/access-denied');

        if(Feedback::where('read_status', 'unseen')->count() > 0)
        {
            Feedback::where('read_status', 'unseen')->update([
               'read_status' => 'seen',
                'seen_by' => Auth::guard('admin')->user()->id
            ]);
        }
        $data = Feedback::orderBy('id', 'DESC')->paginate('10');
        return view('admin.feedback.list', compact('data'));
    }
}

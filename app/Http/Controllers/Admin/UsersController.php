<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\RoleManager;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Customers'))
            return redirect('admin/access-denied');

        $users = User::orderBy('id', 'DESC')->paginate('10');
        return view('admin.user.list', compact('users'));
    }

    public function changeStatus($id)
    {
        if(!RoleManager::checkHasRoles('Customers'))
            return redirect('admin/access-denied');

        if(User::find($id)->status == 'active')
        {
            User::find($id)->update([
                'status' => 'suspended'
            ]);
        } else {
            User::find($id)->update([
                'status' => 'active'
            ]);
        }
        return redirect()->back()->with('message', 'Status successfully changed.');
    }
}

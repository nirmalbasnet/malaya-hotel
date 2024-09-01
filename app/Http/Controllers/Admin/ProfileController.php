<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Admin;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Profile'))
            return redirect('admin/access-denied');

        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function update(Request $request)
    {
        if(!RoleManager::checkHasRoles('Profile'))
            return redirect('admin/access-denied');

        Admin::find(Auth::guard('admin')->user()->id)->update([
           $request->field => $request->field == 'password' ? bcrypt($request->value) : $request->value
        ]);

        return $request->value;
    }
}

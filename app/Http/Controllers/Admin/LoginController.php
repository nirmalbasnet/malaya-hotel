<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Admin;
use App\BackendModel\SubAdminRoles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
//        $a = 0;
//        if($a == 0)
//            dd('invalid');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function validation(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $data = $request->all();
        $check = Auth::guard('admin')->attempt([
            'email' => $data['username'],
            'password' => $data['password']
        ]);
        if ($check) {
            $loggedInUser = Auth::guard('admin')->user();
            if($loggedInUser->has_roles == 'no' && $loggedInUser->designation == 'staff')
            {
                return redirect('admin/login')->with('error', 'You do not have any roles  !')->withInput();
            }

            if($loggedInUser->suspend == 'yes')
            {
                return redirect('admin/login')->with('error', 'You have been suspended  !')->withInput();
            }

            if($loggedInUser->designation == 'staff')
            {
                $subAdminsSessionArry = SubAdminRoles::where('admin_id', $loggedInUser->id)->pluck('roles')->toArray();
                Session::put('subAdminsSessionArray', $subAdminsSessionArry);
            }

            return redirect('admin/dashboard');
        } else {
            $check = Admin::where('username', $data['username'])->first();
            if ($check == null) {
                return redirect('admin/login')->with('error', 'Invalid Credential  !')->withInput();
            } else {
                if (Hash::check($data['password'], $check->password)) {
                    if($check->has_roles == 'no' && $check->designation == 'staff')
                    {
                        return redirect('admin/login')->with('error', 'You do not have any roles  !')->withInput();
                    }

                    if($check->suspend == 'yes')
                    {
                        return redirect('admin/login')->with('error', 'You have been suspended  !')->withInput();
                    }
                    Auth::guard('admin')->login($check);
                    if($check->designation == 'staff')
                    {
                        $subAdminsSessionArry = SubAdminRoles::where('admin_id', $check->id)->pluck('roles')->toArray();
                        Session::put('subAdminsSessionArray', $subAdminsSessionArry);
                    }
                    return redirect('admin/dashboard');
                }else{
                    return redirect('admin/login')->with('error', 'Invalid Credential  !')->withInput();
                }
            }
        }
    }

    public function logout()
    {
        if(Session::has('subAdminsSessionArray'))
        {
            Session::forget('subAdminsSessionArray');
        }
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}

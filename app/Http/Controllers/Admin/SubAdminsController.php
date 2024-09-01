<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Admin;
use App\BackendModel\SubAdminRoles;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SubAdminsController extends Controller
{
    public function index()
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        $subAdmins = Admin::where('designation', 'staff')->paginate('10');
        return view('admin.sub-admins.list', compact('subAdmins'));
    }

    public function create(Request $request)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:admins',
            'email' => 'required|unique:admins|email',
            'password' => 'required|min:6',
            'suspend' => 'required'
        ]);
        if ($validator->fails()) {
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            return $data;
        }

        $storeData = $request->except('_token');
        $storeData['designation'] = 'staff';
        $storeData['password'] = bcrypt($request->password);
        $storeData['has_roles'] = 'no';
        $created = Admin::create($storeData);
        $retData['status'] = 'success';
        $retData['id'] = $created->id;
        return $retData;
    }

    public function update($id, Request $request)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'suspend' => 'required'
        ]);
        if ($validator->fails()) {
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            return $data;
        }

        if (Admin::find($id)->username != $request->username) {
            $validator = Validator::make($request->all(), [
                'username' => 'unique:admins',
            ]);
            if ($validator->fails()) {
                $data['status'] = 'error';
                $data['message'] = $validator->errors()->first();
                return $data;
            }
        }

        if (Admin::find($id)->email != $request->email) {
            $validator = Validator::make($request->all(), [
                'email' => 'unique:admins|email',
            ]);
            if ($validator->fails()) {
                $data['status'] = 'error';
                $data['message'] = $validator->errors()->first();
                return $data;
            }
        }

        $storeData = $request->except('_token');
        $storeData['designation'] = 'staff';

        if ($request->password != null) {
            $validator = Validator::make($request->all(), [
                'password' => 'min:6',
            ]);
            if ($validator->fails()) {
                $data['status'] = 'error';
                $data['message'] = $validator->errors()->first();
                return $data;
            }

            $storeData['password'] = bcrypt($request->password);
        } else {
            unset($storeData['password']);
        }


        $data['status'] = 'success';
        $data['id'] = $id;

        Admin::find($id)->update($storeData);
        return $data;
    }

    public function roles($id)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        $admin = Admin::find($id);
        $roles = SubAdminRoles::where('admin_id', $id)->get();
        if ($roles->count() == 0) {
            $roles = null;
        } else {
            $roles = SubAdminRoles::where('admin_id', $id)->pluck('roles')->toArray();
        }

        return view('admin.sub-admins.roles', compact('roles', 'admin'));
    }

    public function submitRoles($id, Request $request)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        $data = $request->except('_token');
        if (!isset($data['roles']) || count($data['roles']) == 0) {
            Admin::find($id)->update([
                'has_roles' => 'no'
            ]);
            if (SubAdminRoles::where('admin_id', $id)->count() > 0) {
                SubAdminRoles::where('admin_id', $id)->delete();
            }
        } else {
            Admin::find($id)->update([
                'has_roles' => 'yes'
            ]);
            if (SubAdminRoles::where('admin_id', $id)->count() > 0) {
                SubAdminRoles::where('admin_id', $id)->delete();
            }
            foreach ($data['roles'] as $datum) {
                SubAdminRoles::create([
                    'admin_id' => $id,
                    'roles' => $datum,
                    'created_by' => Auth::guard('admin')->user()->id
                ]);
            }
        }

        return redirect('admin/staffs')->with('message', 'Process Successful');
    }

    public function suspend($id)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        Admin::find($id)->update([
            'suspend' => 'yes'
        ]);
        return redirect()->back();
    }

    public function activate($id)
    {
        if(Auth::guard('admin')->user()->designation == 'staff')
            return redirect('admin/access-denied');

        Admin::find($id)->update([
            'suspend' => 'no'
        ]);
        return redirect()->back();
    }
}

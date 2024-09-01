<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Testimony;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TestimonyController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        $testimonies = Testimony::orderBy('id', 'DESC')->paginate('10');
        return view('admin.testimony.index', compact('testimonies'));
    }

    public function add()
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        return view('admin.testimony.create');
    }

    public function edit($testimonyId)
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        $testimony = Testimony::find($testimonyId);
        return view('admin.testimony.edit', compact('testimony'));
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|sometimes|image|dimensions:min_width=400,min_height=400',
            'status' => 'required'
        ]);

        $storeData = $request->except('_token');

        if ($request->hasFile('image')) {
            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/clients-testimony/small/';
            $originalPath = public_path() . '/images/clients-testimony/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
            $storeData['image'] = $fileName;
        }

        $storeData['created_by'] = Auth::guard('admin')->user()->id;

        Testimony::create($storeData);
        return redirect('admin/clients-testimony')->with('message', 'Bravo ! Task Successfully Done !');
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|sometimes|image|dimensions:min_width=400,min_height=400',
            'status' => 'required'
        ]);

        $storeData = $request->except('_token');

        if ($request->hasFile('image')) {
            $oldImage = Testimony::find($id)->image;

            if($oldImage != null)
            {
                if(file_exists(public_path('images/clients-testimony/small/'.$oldImage)))
                {
                    unlink(public_path('images/clients-testimony/small/'.$oldImage));
                }

                if(file_exists(public_path('images/clients-testimony/big/'.$oldImage)))
                {
                    unlink(public_path('images/clients-testimony/big/'.$oldImage));
                }
            }

            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/clients-testimony/small/';
            $originalPath = public_path() . '/images/clients-testimony/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
            $storeData['image'] = $fileName;
        }

        $storeData['created_by'] = Auth::guard('admin')->user()->id;

        Testimony::find($id)->update($storeData);
        return redirect('admin/clients-testimony')->with('message', 'Bravo ! Task Successfully Done !');
    }

    public function activate($id)
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        Testimony::find($id)->update([
           'status' => 'active'
        ]);
        return redirect()->back()->with('message', 'Successfully Activated');
    }

    public function inactivate($id)
    {
        if(!RoleManager::checkHasRoles('Clients Testimony'))
            return redirect('admin/access-denied');

        Testimony::find($id)->update([
            'status' => 'inactive'
        ]);
        return redirect()->back()->with('message', 'Successfully De Activated');
    }
}

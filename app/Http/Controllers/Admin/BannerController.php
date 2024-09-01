<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Banner;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $banners = Banner::orderBy('order_number', 'ASC')->paginate('10');
        return view('admin.banner.banner', compact('banners'));
    }

    public function create()
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        return view('admin.banner.create');
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'text' => 'required',
            'image' => 'required|image|dimensions:min_width=1920,min_height=1050',
            'status' => 'required',
        ]);
        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $originalImage = Image::make($uploadedImage);
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . '.' . $mimeTypeArray[1];
            $originalImage->resize(1920, 1050);
            $originalPath = public_path() . '/images/banners/';
            $originalImage->save($originalPath . $fileName);
            $data['image'] = $fileName;
        }

        $data['created_by'] = Auth::guard('admin')->user()->id;

        $order = Banner::count() + 1;
        $data['order_number'] = $order;

        Banner::create($data);
        return redirect('admin/banner');
    }

    public function edit($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $data = Banner::find($id);
        return view('admin.banner.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'text' => 'required',
            'image' => 'sometimes|required|image|dimensions:min_width=1920,min_height=1050',
            'status' => 'required',
        ]);
        $data = $request->except('_token');
        if ($request->hasFile('image')) {
            $oldBanner = Banner::find($id)->image;
            if (file_exists(public_path('images/banners/' . $oldBanner))) {
                unlink(public_path('images/banners/' . $oldBanner));
            }
            $uploadedImage = $request->file('image');
            $originalImage = Image::make($uploadedImage);
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . '.' . $mimeTypeArray[1];
            $originalImage->resize(1920, 1050);
            $originalPath = public_path() . '/images/banners/';
            $originalImage->save($originalPath . $fileName);
            $data['image'] = $fileName;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Banner::find($id)->update($data);
        return redirect('admin/banner');
    }

    public function delete($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $bannerImage = Banner::find($id)->image;
        if (file_exists(public_path('images/banners/' . $bannerImage))) {
            unlink(public_path('images/banners/' . $bannerImage));
        }
        Banner::find($id)->delete();
        return redirect()->back();
    }

    public function orderUp($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $currentOrder = Banner::find($id)->order_number;
        $itemBefore = Banner::where('order_number', $currentOrder - 1)->first();
        Banner::find($itemBefore->id)->update(['order_number' => $currentOrder]);
        Banner::find($id)->update(['order_number' => $currentOrder - 1]);
        return redirect()->back();
    }

    public function orderDown($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        $currentOrder = Banner::find($id)->order_number;
        $itemAfter = Banner::where('order_number', $currentOrder + 1)->first();
        Banner::find($itemAfter->id)->update(['order_number' => $currentOrder]);
        Banner::find($id)->update(['order_number' => $currentOrder + 1]);
        return redirect()->back();
    }

    public function activate($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        Banner::find($id)->update(['status' => 'active']);
        return redirect()->back();
    }

    public function inactivate($id)
    {
        if(!RoleManager::checkHasRoles('Banner'))
            return redirect('admin/access-denied');

        Banner::find($id)->update(['status' => 'inactive']);
        return redirect()->back();
    }
}

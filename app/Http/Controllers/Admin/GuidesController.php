<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\Guides;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class GuidesController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        $guides = Guides::orderBy('id', 'DESC')->paginate('10');
        return view('admin.guides.list', compact('guides'));
    }

    public function create()
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        return view('admin.guides.create');
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        $this->validate($request, [
           'name' => 'required',
           'category' => 'required',
           'image' => 'required|image|dimensions:min_width=400,min_height=400',
        ]);

        if(isset($request->fb_link) && $request->fb_link != null)
        {
            $this->validate($request, [
                'fb_link' => 'url',
            ]);
        }

        if(isset($request->skype_link) && $request->skype_link != null)
        {
            $this->validate($request, [
                'skype_link' => 'url',
            ]);
        }

        if(isset($request->insta_link) && $request->insta_link != null)
        {
            $this->validate($request, [
                'insta_link' => 'url',
            ]);
        }

        if(isset($request->linkedin_link) && $request->linkedin_link != null)
        {
            $this->validate($request, [
                'linkedin_link' => 'url',
            ]);
        }
        $data = [
          'name' => $request->name,
          'category' => $request->category,
          'fb_link' => isset($request->fb_link) ? $request->fb_link : 'N/A',
          'skype_link' => isset($request->skype_link) ? $request->skype_link : 'N/A',
          'insta_link' => isset($request->insta_link) ? $request->insta_link : 'N/A',
          'linkedin_link' => isset($request->linkedin_link) ? $request->linkedin_link : 'N/A',
        ];
        if ($request->hasFile('image')) {
            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/guides/small/';
            $originalPath = public_path() . '/images/guides/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
           $data['image'] = $fileName;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Guides::create($data);
        return redirect('admin/guides')->with('message', 'Guide successfully created');
    }

    public function edit($id)
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        $guide = Guides::find($id);
        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
        ]);

        if(isset($request->fb_link) && $request->fb_link != null)
        {
            $this->validate($request, [
                'fb_link' => 'url',
            ]);
        }

        if(isset($request->skype_link) && $request->skype_link != null)
        {
            $this->validate($request, [
                'skype_link' => 'url',
            ]);
        }

        if(isset($request->insta_link) && $request->insta_link != null)
        {
            $this->validate($request, [
                'insta_link' => 'url',
            ]);
        }

        if(isset($request->linkedin_link) && $request->linkedin_link != null)
        {
            $this->validate($request, [
                'linkedin_link' => 'url',
            ]);
        }
        $data = [
            'name' => $request->name,
            'category' => $request->category,
            'fb_link' => isset($request->fb_link) ? $request->fb_link : 'N/A',
            'skype_link' => isset($request->skype_link) ? $request->skype_link : 'N/A',
            'insta_link' => isset($request->insta_link) ? $request->insta_link : 'N/A',
            'linkedin_link' => isset($request->linkedin_link) ? $request->linkedin_link : 'N/A',
        ];
        if ($request->hasFile('image')) {
            $this->validate($request, [
                'image' => 'required|image|dimensions:min_width=400,min_height=400',
            ]);
            $oldImage = Guides::find($id)->image;
            if(file_exists(public_path() . '/images/guides/small/'.$oldImage))
            {
                unlink(public_path() . '/images/guides/small/'.$oldImage);
            }
            if(file_exists(public_path() . '/images/guides/big/'.$oldImage))
            {
                unlink(public_path() . '/images/guides/big/'.$oldImage);
            }
            $originalImage = Image::make($request->file('image'));
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(400, 400);
            $thumbnailPath = public_path() . '/images/guides/small/';
            $originalPath = public_path() . '/images/guides/big/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(100, 100);
            $originalImage->save($thumbnailPath . $fileName);
            $data['image'] = $fileName;
        }
        $data['created_by'] = Auth::guard('admin')->user()->id;
        Guides::find($id)->update($data);
        return redirect('admin/guides')->with('message', 'Guide successfully updated');
    }

    public function delete($id)
    {
        if(!RoleManager::checkHasRoles('Guides'))
            return redirect('admin/access-denied');

        $oldImage = Guides::find($id)->image;
        if(file_exists(public_path() . '/images/guides/small/'.$oldImage))
        {
            unlink(public_path() . '/images/guides/small/'.$oldImage);
        }
        if(file_exists(public_path() . '/images/guides/big/'.$oldImage))
        {
            unlink(public_path() . '/images/guides/big/'.$oldImage);
        }
        Guides::find($id)->delete();
        return redirect()->back()->with('message', 'Guide successfully deleted');
    }
}

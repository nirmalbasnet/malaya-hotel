<?php

namespace App\Http\Controllers\Admin;

use App\BackendModel\BlogCategory;
use App\BackendModel\Destination;
use App\BackendModel\DestinationImages;
use App\BackendModel\DestinationItinerary;
use App\BackendModel\DestinationReview;
use App\Helpers\RoleManager;
use App\Helpers\SlugMaker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class DestinationController extends Controller
{
    public function index()
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destinations = Destination::orderBy('id', 'DESC')->paginate('10');
        return view('admin.destination.index', compact('destinations'));
    }

    public function create()
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        return view('admin.destination.create');
    }

    public function submit(Request $request)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'title' => 'required',
            'trip_destination' => 'required',
            'total_duration' => 'required',
            'difficulty' => 'required',
            'primary_activities' => 'required',
            'group_size' => 'required',
            'transportation' => 'required',
            'price' => 'required',
            'top' => 'required',
            'summary' => 'required',
            'review' => 'required',
        ]);

        $data = $request->except('_token');
        $data['slug'] = str_slug($data['title']);
        $data['created_by'] = Auth::guard('admin')->user()->id;
        $created = Destination::create($data);

        return redirect('admin/destinations/' . $created->id . '/featured-images');
    }

    public function featuredImages($destinationId)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destination = Destination::find($destinationId);
        return view('admin.destination.featured-images', compact('destination'));
    }

    public function submitFeaturedImages(Request $request, $did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        foreach ($request->image as $img) {
            $originalImage = Image::make($img);
            $mimeTypeArray = array_map('trim', explode('/', $originalImage->mime));
            $fileName = strtotime(date('Y-m-d H:i:s')) . uniqid() . '.' . $mimeTypeArray[1];
            $originalImage->resize(1920, 1050);
            $thumbnailPath = public_path() . '/images/destinations/thumbs/';
            $originalPath = public_path() . '/images/destinations/banners/';
            $originalImage->save($originalPath . $fileName);
            $originalImage->resize(300, 180);
            $originalImage->save($thumbnailPath . $fileName);
            DestinationImages::create([
                'destination_id' => $did,
                'image' => $fileName,
                'created_by' => Auth::guard('admin')->user()->id
            ]);
        }

        return redirect('admin/destinations/' . $did . '/itineraries');
    }

    public function itineraries($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destination = Destination::find($did);
        return view('admin.destination.itenaries', compact('destination'));
    }

    public function submitItineraries(Request $request, $did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $data = $request->itinerary;
        $destination = Destination::find($did);
        if(isset($destination->destinationItineraries) && $destination->destinationItineraries->count() > 0)
            $day = $destination->destinationItineraries->count();
        else
            $day = 0;
        foreach ($data as $datum){
            if($datum != null)
            {
                $day++;
                DestinationItinerary::create([
                    'destination_id' => $did,
                    'itinerary' => $datum,
                    'day' => $day,
                    'created_by' => Auth::guard('admin')->user()->id
                ]);
            }
        }

        return redirect('admin/destinations')->with('message', 'Bravo ! Task successfully done');
    }

    public function updateItineraries(Request $request, $id)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $day = $request->day;
        $itinerary = $request->itinerary;
        $it = DestinationItinerary::find($id);
        $originalDay = $it->day;
        $destId = $it->destination_id;
        if($day > $originalDay)
        {
            if(DestinationItinerary::where('destination_id', $destId)->where('day', '>', $originalDay)->where('day', '<=', $day)->count() > 0)
            {
                foreach (DestinationItinerary::where('destination_id', $destId)->where('day', '>', $originalDay)->where('day', '<=', $day)->get() as $i)
                {
                    DestinationItinerary::find($i->id)->update([
                       'day' =>  DestinationItinerary::find($i->id)->day - 1
                    ]);
                }
            }
            DestinationItinerary::find($it->id)->update([
               'day' => $day,
                'itinerary' => $itinerary
            ]);
        }elseif($day < $originalDay)
        {
            if(DestinationItinerary::where('destination_id', $destId)->where('day', '<', $originalDay)->where('day', '>=', $day)->count() > 0)
            {
                foreach (DestinationItinerary::where('destination_id', $destId)->where('day', '<', $originalDay)->where('day', '>=', $day)->get() as $i)
                {
                    DestinationItinerary::find($i->id)->update([
                        'day' =>  DestinationItinerary::find($i->id)->day + 1
                    ]);
                }
            }
            DestinationItinerary::find($it->id)->update([
                'day' => $day,
                'itinerary' => $itinerary
            ]);
        }else{
            DestinationItinerary::find($it->id)->update([
                'day' => $day,
                'itinerary' => $itinerary
            ]);
        }

        return redirect()->back();
    }

    public function deleteItineraries($itd)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $iti = DestinationItinerary::find($itd);
        $destinationId = $iti->destination_id;
        $originalDay = $iti->day;
        if(DestinationItinerary::where('destination_id', $destinationId)->where('day', '>', $originalDay)->count() > 0)
        {
            foreach (DestinationItinerary::where('destination_id', $destinationId)->where('day', '>', $originalDay)->get() as $mdi)
            {
                DestinationItinerary::find($mdi->id)->update([
                   'day' =>  DestinationItinerary::find($mdi->id)->day - 1
                ]);
            }
        }
        DestinationItinerary::find($itd)->delete();
        return redirect()->back();
    }

    public function edit($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destination = Destination::find($did);
        return view('admin.destination.edit', compact('destination'));
    }

    public function update($did, Request $request)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $this->validate($request, [
            'title' => 'required',
            'trip_destination' => 'required',
            'total_duration' => 'required',
            'difficulty' => 'required',
            'primary_activities' => 'required',
            'group_size' => 'required',
            'transportation' => 'required',
            'price' => 'required',
            'top' => 'required',
            'summary' => 'required',
            'review' => 'required',
        ]);

        Destination::find($did)->update($request->except('_token'));
        return redirect('admin/destinations')->with('message', 'Destination successfully updated');
    }

    public function view($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destination = Destination::find($did);
        return view('admin.destination.view', compact('destination'));
    }

    public function deleteFeaturedImages($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destinationId = DestinationImages::find($did)->destination_id;
        if(DestinationImages::where('destination_id', $destinationId)->count() == 1)
        {
            Destination::find($destinationId)->update([
               'publish' => 'no'
            ]);
        }
        DestinationImages::find($did)->delete();
        return 'success';
    }

    public function delete($id)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        Destination::find($id)->delete();
        return redirect('admin/destinations')->with('message', 'Bravo ! Task successfully done');
    }


    public function top($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        Destination::find($did)->update([
           'top' => 'yes'
        ]);
        return redirect()->back()->with('message', 'Bravo ! Task successfully done');
    }

    public function untop($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        Destination::find($did)->update([
            'top' => 'no'
        ]);
        return redirect()->back()->with('message', 'Bravo ! Task successfully done');
    }

    public function publish($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        if(Destination::find($did)->destinationImages->count() == 0)
        {
            return redirect()->back()->with('message', 'Sorry ! First upload destination images to publish it.');
        }
        Destination::find($did)->update([
            'publish' => 'yes'
        ]);
        return redirect()->back()->with('message', 'Bravo ! Task successfully done');
    }

    public function unpublish($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        Destination::find($did)->update([
            'publish' => 'no'
        ]);
        return redirect()->back()->with('message', 'Bravo ! Task successfully done');
    }

    public function reviews($did)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        $destination = Destination::find($did);
        $reviews = $destination->destinationReviews;
        return view('admin.destination.reviews', compact('destination', 'reviews'));
    }

    public function approveReview($rid)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        DestinationReview::find($rid)->update([
            'status' => 'active',
            'reviewed' => 'yes'
        ]);
        return redirect()->back()->with('message', 'Review Successfully Approved');
    }

    public function disapproveReview($rid)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        DestinationReview::find($rid)->update([
            'status' => 'inactive',
            'reviewed' => 'yes'
        ]);
        return redirect()->back()->with('message', 'Review Successfully Disapproved');
    }

    public function deleteReview($rid)
    {
        if(!RoleManager::checkHasRoles('Destinations'))
            return redirect('admin/access-denied');

        DestinationReview::find($rid)->delete();
        return redirect()->back()->with('message', 'Review Successfully Deleted');
    }
}

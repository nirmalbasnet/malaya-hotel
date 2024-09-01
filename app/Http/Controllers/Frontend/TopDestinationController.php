<?php

namespace App\Http\Controllers\Frontend;

use App\BackendModel\Contact;
use App\BackendModel\Destination;
use App\BackendModel\DestinationReview;
use App\BackendModel\EmailNotification;
use App\Booking;
use App\Mail\BookingAlert;
use App\Mail\DestinationReviewNotification;
use App\Mail\InquiryAlert;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TopDestinationController extends Controller
{
    public function detail($slug)
    {
        $destination = Destination::where('slug', $slug)->first();
        $randomDestination = Destination::where('id', '<>', $destination->id)->where('top', 'yes')->where('publish', 'yes')->inRandomOrder()->take('5')->get();
        return view('frontend.destination-detail', compact('destination', 'randomDestination'));
    }

    public function submitReview(Request $request, $slug)
    {
        $destination = Destination::where('slug', $slug)->first();
        $data = [
            'destination_id' => $destination->id,
            'review' => $request->review,
            'star_count' => isset($request->star_count) ? $request->star_count : 0
        ];

        if(Auth::check())
        {
            $data['user_id'] = Auth::id();
            DestinationReview::create($data);
            if(EmailNotification::first() != null && EmailNotification::first()->destination_review_alert != null)
            {
                Mail::to(EmailNotification::first()->destination_review_alert)->send(new DestinationReviewNotification($data));
            }
            return redirect()->back()->with('review-redirect-message', 'review');
        }else{
            $request->session()->put('sessionForDestinationReview', $data);
            $request->session()->put('sessionForDestinationReviewUrl', $request->page_url);
            return redirect('login');
        }
    }

    public function bookTopDestination(Request $request, $destinationId)
    {
        $data = $request->all();
        $data['destination_id'] = $destinationId;
        Booking::create($data);
        if(EmailNotification::first()->booking_alert != null)
        {
            Mail::to(EmailNotification::first()->booking_alert)->send(new BookingAlert($data));
        }

        return 'success';
    }


    public function inquiry(Request $request, $destinationId)
    {
        $data = $request->all();
        $data['destination_id'] = $destinationId;
        Contact::create($data);
        if(EmailNotification::first()->inquiry_alert != null)
        {
            Mail::to(EmailNotification::first()->inquiry_alert)->send(new InquiryAlert($data));
        }
        return 'success';
    }

    public function all()
    {
        $destinations = Destination::where('top', 'yes')->where('publish', 'yes')->orderBy('id', 'DESC')->paginate('6');
        $count = Destination::where('top', 'yes')->where('publish', 'yes')->count();
        return view('frontend.all-top-destinations', compact('destinations', 'count'));
    }
}

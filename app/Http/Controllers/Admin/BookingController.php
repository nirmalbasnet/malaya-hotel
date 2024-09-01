<?php

namespace App\Http\Controllers\Admin;

use App\Booking;
use App\Helpers\RoleManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function booking()
    {
        if(!RoleManager::checkHasRoles('Bookings'))
            return redirect('admin/access-denied');

        $bookings = Booking::orderBy('id', 'DESC')->paginate('10');
        return view('admin.booking', compact('bookings'));
    }

    public function bookingAck($id)
    {
        if(!RoleManager::checkHasRoles('Bookings'))
            return redirect('admin/access-denied');

        Booking::find($id)->update([
           'acknowledged_by' => Auth::guard('admin')->id()
        ]);
        return redirect()->back()->with('message', 'Bravo ! Task Successfully Done');
    }
}

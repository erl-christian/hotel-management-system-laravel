<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;

class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found');
        }

        return view('home.room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'date|after:startDate',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
        ]);
        $data = new Booking();

        $data->room_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        $startDate = $request->startDate;
        $endDate = $request->endDate;

        $isBooked = Booking::where('room_id', $id)->where('start_date', '<=', $endDate)->where('end_date', '>=', $startDate)->exists();

        if($isBooked)
        {
            return redirect()->back()->with('message','Room already Booked Please Choose different date');
        }
        else
        {
            $data->start_date = $request->startDate;
            $data->end_date = $request->endDate;

            $data->save();

            return redirect()->back()->with('message','Room Booked Succesfully');
        }


    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:5000'
        ]);

        $contact = new Contact;

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back()->with('message','Message Sent Succesfully');

    }

    public function our_rooms()
    {
        $room = Room::all();
        return view('home.our_rooms', compact('room'));
    }

    public function hotel_gallery()
    {
        $gallery = Gallery::all();
        return view('home.hotel_gallery', compact('gallery'));
    }

    public function contact_us()
    {

        return view('home.contact_us');
    }

    public function about_us()
    {

        return view('home.about_us');
    }




}

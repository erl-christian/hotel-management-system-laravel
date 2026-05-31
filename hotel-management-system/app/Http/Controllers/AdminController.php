<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use App\Notifications\SendEmailNotifications;
use Illuminate\Support\Facades\Notification;


class AdminController extends Controller
{
    public function index()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;

            if($usertype == 'user'){
                $room = Room::all();
                $gallery = Gallery::all();

                return view('home.index', compact('room', 'gallery'));
            }
            else if($usertype == 'admin'){
                return view('admin.index');
            }
            else{
                return redirect()->back();
            }
        }
        
        return redirect()->route('login');
    }

    public function home()
    {
        $room = Room::all();

        $gallery = Gallery::all();

        return view('home.index', compact('room', 'gallery'));
    }

    public function create_room()
    {
        return view('admin.create_room');
    }

    public function add_room(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'wifi' => 'required|string',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = new Room;
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('room', $imagename);

            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back();
    }

    public function view_room()
    {
        $data = Room::all();

        return view('admin.view_room', compact('data'));
    }

    public function room_delete($id)
    {
        $data = Room::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->back();
    }

    public function room_update($id)
    {
        $data = Room::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Room not found');
        }
        return view('admin.update_room', compact('data'));
    }

    public function edit_room(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'wifi' => 'required|string',
            'type' => 'required|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = Room::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Room not found');
        }

        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;
        if ($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('room', $imagename);

            $data->image = $imagename;
        }

        $data->save();

        return redirect()->back();

    }

    public function bookings()
    {
        $data = Booking::all();
        return view('admin.bookings', compact('data'));
    }

    public function booking_delete($id)
    {
        $data = Booking::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->back();
    }

    public function approve_book($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            $booking->status = 'approve';
            $booking->save();

            $details = [
                'greeting' => 'Hello, ' . $booking->name,
                'body' => 'We are pleased to inform you that your booking for room ' . ($booking->room ? $booking->room->room_title : 'N/A') . ' has been approved!',
                'action_text' => 'Use this link to view our hotel',
                'action_url' => 'https://maps.app.goo.gl/NVyFMnWkoGF1bd7JA',
                'endline' => 'Thank you for choosing our service!',
            ];

            Notification::route('mail', $booking->email)->notify(new SendEmailNotifications($details));

            return redirect()->back()->with('message', 'Booking approved and email sent successfully!');
        }

        return redirect()->back()->with('error', 'Booking not found!');

    }
    public function reject_book($id)
    {
        $booking  = Booking::find($id);

        if ($booking) {
            $booking->status = 'rejected';
            $booking->save();
        }

        return redirect()->back();

    }

    public function view_gallery()
    {
        $gallery = Gallery::all();
        return view('admin.view_gallery', compact('gallery'));
    }

    public function upload_gallery(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = new Gallery;

        $image = $request->image;

        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();

            $request->image->move('gallery', $imagename);

            $data->images = $imagename;

        }

        $data->save();

        return redirect()->back();
    }

    public function delete_image($id)
    {
        $data = Gallery::find($id);

        if ($data) {
            $data->delete();
        }

        return redirect()->back();
    }
    public function all_messages()
    {
        $message = Contact::all();
        return view('admin.all_messages', compact('message'));
    }
    public function send_mail($id)
    {
        $data = Contact::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Contact not found');
        }
        return view('admin.send_mail', compact('data'));
    }

    public function mail(Request $request, $id)
    {
        $request->validate([
            'greeting' => 'required|string|max:255',
            'body' => 'required|string',
            'action_text' => 'required|string|max:255',
            'action_url' => 'required|url',
            'endline' => 'required|string|max:255'
        ]);

        $data = Contact::find($id);
        if (!$data) {
            return redirect()->back()->with('error', 'Contact not found');
        }

        $details = [
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'endline' => $request->endline,
        ];

        Notification::send($data, new SendEmailNotifications($details));

        return redirect()->back();
    }
}

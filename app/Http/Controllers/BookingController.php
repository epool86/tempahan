<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use App\Models\Booking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_id = isset($_GET['room_id']) ? $_GET['room_id'] : "ALL";
        $month = isset($_GET['month']) ? $_GET['month'] : "ALL";
        $year = isset($_GET['year']) ? $_GET['year'] : "ALL";

        $bookings = Booking::query();

        if($room_id != 'ALL'){
            $bookings = $bookings->where('room_id', $room_id);
        }

        if($month != 'ALL'){
            $bookings = $bookings->whereMonth('booking_date', $month);
        }

        if($year != 'ALL'){
            $bookings = $bookings->whereYear('booking_date', $year);
        }

        $bookings = $bookings->paginate(5);

        $rooms = Room::orderBy('name','ASC')->get();
        return view('admin.booking_index', compact('bookings', 'rooms', 'room_id', 'month', 'year'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::find($id);

        if($request['action'] == 'approve'){
            $booking->status = 1;
        } elseif($request['action'] == 'reject'){
            $booking->status = 2;
        }

        $booking->save();

        return redirect()->route('admin.booking.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

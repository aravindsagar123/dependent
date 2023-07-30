<?php

namespace App\Http\Controllers;
use App\Models\Hotel;
use App\Models\Room;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function hotel()
    {
        $hotels = Hotel::all();
        return view('hotels', compact('hotels'));
    }
    public function fetchrooms($hotel_id)
    {
        $rooms = DB::table('rooms')->where('Hotel_id', $hotel_id)->get();
        return response()->json([
            'status' => 1,
            'rooms' => $rooms,
        ]);
    }
   
}


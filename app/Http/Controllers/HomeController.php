<?php

namespace App\Http\Controllers;

use App\Models\HotelFacility;
use App\Models\RoomType;
use Illuminate\Http\Request;
use App\Models\Room;
use Auth;
use App\Models\Activity;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $roomTypes = RoomType::all();
        $hotelFacilities = HotelFacility::all();
        if (!Auth::check()) {
            return view('landing', compact('roomTypes', 'hotelFacilities'));
        }elseif(auth()->user()->role == 'admin'){
            return redirect()->route('admin.home');
        }
        elseif(auth()->user()->role == 'resepsionis'){
            return view('receptionis.home');
        }
        elseif(auth()->user()->role == 'customer'){
            return view('landing', compact('roomTypes', 'hotelFacilities'));
        }
    }

    public function admin()
{
    $occupied = Room::where('status', 'o')->count();   // Occupied Rooms
    $reserved = Room::where('status', 'r')->count();  // Reserved Rooms
    $os = Room::where('status', 'os')->count();       // Out of service
    $available = Room::where('status', 'v')->count(); // Available Rooms

    $activities = Activity::latest()->take(10)->get(); // Ambil 10 aktivitas terbaru

    // ✅ Tambahkan $activities ke compact()
    return view('admin.home', compact('occupied', 'reserved', 'os', 'available', 'activities'));
}

    public function receptionis()
    {
        return view('receptionis.home');
    }

    public function clearLogsNow()
    {
        Activity::truncate();
        return redirect()->back()->with('status', 'Semua riwayat activity sudah dibersihkan!');
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Contact;
use App\Models\Offer;
use App\Models\Test;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $offers = User::get()->count();

        $lastOffers = User::orderBy('id','DESC')->take(5)->get();

        return view('dashboard.index',compact('offers',
        'lastOffers'));
    }
}

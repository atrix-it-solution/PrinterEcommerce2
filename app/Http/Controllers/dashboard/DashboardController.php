<?php

namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

 

    public function index()
    {
        return view('pages.dashboard.home-dashboard');
    }

    public function products()
    {
        return view('pages.dashboard.products');
    }

    public function orders()
    {
        return view('pages.dashboard.orders');
    }
    public function dashboardsettings()
    {
        return view('pages.dashboard.dashboard-settings');
    }
}
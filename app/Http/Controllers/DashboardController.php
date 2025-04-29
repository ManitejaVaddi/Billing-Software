<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Here, you can add logic to fetch any data you want for the dashboard.
        return view('dashboard');
    }
}

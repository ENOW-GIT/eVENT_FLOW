<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index()
    {
        return view('organizer.dashboard');  // Display the organizer's dashboard
    }
}
  
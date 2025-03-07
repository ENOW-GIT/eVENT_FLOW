<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookerController extends Controller
{
    public function index()
    {
        return view('booker.eventlist');  // Display the booker's event list
    }
}

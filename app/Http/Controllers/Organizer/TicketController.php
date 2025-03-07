<?php

namespace App\Http\Controllers\Organizer;


use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Event;

class TicketController extends Controller
{
    public function create()
    {
        $events = Event::all(); // Fetch all events
        return view('organizer.tickets.create', compact('events'));
    }

    public function store(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'type' => 'required|array',
            'price' => 'required|array',
            'quantity' => 'required|array',
            'type.*' => 'required|string|max:255',
            'price.*' => 'required|numeric|min:0',
            'quantity.*' => 'required|integer|min:1',
        ]);


        

        return redirect()->route('organizer.tickets.index')->with('success', 'Tickets created successfully!');
    }
}



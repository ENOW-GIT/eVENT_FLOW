<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;

class EventController extends Controller
{
    public function create()
    {
        $categories = Category::all(); // Fetch all categories

        return view('organizer.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Event::create([
            'name' => $request->name,
            'date' =>\Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->date)->format('Y-m-d H:i:s'), // Convert format
            'location' => $request->location,
            'category_id' => $request->category_id,
            'description' => $request->description,
        ]);

        return redirect()->route('organizer.events.manage')->with('success', 'Event created successfully!');
    } 




public function manage()
{
    $events = Event::all();
    return view('organizer.events.manage', compact('events'));
}


public function show($id)
{
    $event = Event::findOrFail($id); // Fetch event by ID
    return view('organizer.events.view', compact('event'));
}
public function update(Request $request, $id)
{
    $event = Event::findOrFail($id);
    $event->update($request->all());

    return redirect()->route('organizer.events.manage')->with('success', 'Event updated successfully!');
}

public function destroy($id)
{
    $event = Event::findOrFail($id);
    $event->delete();

    return redirect()->route('organizer.events.manage')->with('success', 'Event deleted successfully!');
}



}
  

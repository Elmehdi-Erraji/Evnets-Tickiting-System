<?php

namespace App\Http\Controllers\Orgonizer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $events = Event::where('user_id', $user_id)->get();
        $eventsCount = Event::count();

        foreach ($events as $event) {
            $reservationsCount = $event->users()->count(); // Count the number of reservations for this event
            $event->reservationsCount = $reservationsCount; // Add the count to the event object
        }
        
        return view('orgoniser.events.index', compact('events','eventsCount'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('orgoniser.events.create',compact('categories'));
    }

    public function store (StoreEventRequest  $request)
    {
        
        $event = Event::create($request->all());
        $event->addMediaFromRequest('event')->usingName($event->title)->toMediaCollection('events','events');
        return redirect()->route('event.index')->with('success','event created successfully');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if(Auth::id() !== $event->user_id)
        {
            return redirect()->route('event.index')->with('error', 'You are not authorized to edit this event.');
        }
        $categories = Category::all();
        return view('orgoniser.events.update', compact('event', 'categories'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
     
        $event->update($request->validated());
        if ($request->hasFile('event')) {
            $event->clearMediaCollection('events');
            $event->addMediaFromRequest('event')->usingName($event->title)->toMediaCollection('events', 'events');
        }
        return redirect()->route('event.index')->with('success', 'Event updated successfully');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        if(Auth::id() !== $event->user_id)
        {
            return redirect()->route('event.index')->with('error', 'You are not authorized to view this event.');

        }

        $reservations = $event->users;
        $reservationsCount= $reservations->count();
        
        return view('Orgoniser.Events.show',compact('event','reservations','reservationsCount'));
    }

    public function destroy(Event $event)
    {
        $event->delete();
        if(Auth::id() !== $event->user_id)
        {
            return redirect()->route('event.index')->with('error', 'You are not authorized to delete this event.');
        }
        return redirect()->route('event.index')->with('success','event deleted successfully');
    }

    public function acceptReservation($eventId, $userId)
    {
        $event = Event::findOrFail($eventId);
        $event->users()->updateExistingPivot($userId, ['status' => '1']); 

        return redirect()->back()->with('success', 'Reservation accepted successfully.');
    }

    public function denyReservation($eventId, $userId)
    {
        $event = Event::findOrFail($eventId);
        $event->users()->updateExistingPivot($userId, ['status' => '2']); 

        return redirect()->back()->with('success', 'Reservation denied successfully.');
    }
}

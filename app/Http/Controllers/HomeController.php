<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $searchKey = $request->input('searchKey');
        $query = Event::where('status', 1);
        if ($searchKey) {
            $query->where('title', 'LIKE', "%{$searchKey}%");
        }
    

        $events = $query->paginate(8);
        $catigories = Category::all();

        return view('home', compact('events', 'catigories'));
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $events = Event::where('event_status', 'accepted')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%$query%")
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', "%$query%");
                        });
                })->with('media')->paginate(8);

            $transformedEvents = $events->map(function ($event) {
                $mediaUrl = $event->getFirstMediaUrl('media/events');

                $event['media_url'] = $mediaUrl;

                return $event;
            });

            return response()->json($transformedEvents);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function details($id)
    {
        $event = Event::findOrFail($id);
        return view('eventDetails', compact('event'));
    }
}

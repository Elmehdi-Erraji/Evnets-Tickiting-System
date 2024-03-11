<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EvenController extends Controller
{
    public function index()
    {
        $events = Event::withTrashed()->get();
        return view ('Admin.events.index',compact('events'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'status' => 'required|in:0,1,2', 
        ]);
        $event->status = $request->status;
        $event->save();
        return redirect()->route('events.index')->with('success', 'Event status updated successfully.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.show',compact('event'));
    }

    public function restore($id)
    {
        $event = Event::withTrashed()->findOrFail($id);
        $event->restore();
        return redirect()->route('events.index')->with('success', 'Event restored successfully');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->Delete();
        return redirect()->route('events.index')->with('success','event deleted successfully');
    }

    public function forceDelete($id)
    {
        $event = Event::withTrashed()->findOrFail($id);
        $event->forceDelete();
        return redirect()->route('events.index')->with('success','event removed successfully');
    }

}

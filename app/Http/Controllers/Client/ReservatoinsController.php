<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ReservatoinsController extends Controller
{
    





    public function store(Request $request)
    {
    
        $userId = Auth()->id();
        $eventId = $request->input('event_id');
        $nubmberOfTickets = $request->input('num_tickets');
        
        $event = Event::findOrFail($eventId);
        $remainningSeats = $event->NumberOfSeats;

        if($nubmberOfTickets > 5 || $nubmberOfTickets > $remainningSeats)
        {
            return redirect()->back()->with('error', 'The maximum number of tickets you can reserve is 5 or the remaining seats.');
        }


        if ($event->booking_status == 0) {
            $status = 1;
            $message = 'You booked a seat successfully.';
        } else {
            $status = 0;
            $message = 'Wait for organizer approval to approve the reservation.';
        }

        $event->users()->syncWithoutDetaching([$userId => ['status' => $status , 'num_tickets' => $nubmberOfTickets]]);

        $remainningSeats = $event->NumberOfSeats - $nubmberOfTickets;

        $event->update(['NumberOfSeats' => ($remainningSeats)]);
        return redirect()->back()->with('success', $message);
    }
}

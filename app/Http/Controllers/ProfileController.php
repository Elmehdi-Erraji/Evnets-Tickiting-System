<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $reservations = $user->events()->withPivot('status','num_tickets')->get();
        
        return view('profile.index', compact('user','reservations'));
    }

    public function update(Request $request, $id)
    {
    
            $user = User::findOrFail($id);
            
        
            $user->fullName = $request->input('fullName');
            $user->email = $request->input('email');

            if ($request->hasFile('avatar')) {
                if ($user->getFirstMedia('avatars')) {
                    $user->clearMediaCollection('avatars');
                }
                $user->addMediaFromRequest('avatar')->toMediaCollection('avatars', 'avatars');
            }

            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
    }

   
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function cancel($eventId)
    {
        $user = Auth::user();
         $event = Event::findOrFail($eventId);

         $numTicketsReserved = $user->events()->where('event_id', $eventId)->first()->pivot->num_tickets;
    
        $user->events()->detach($event);
        
        $event->update(['NumberOfSeats' => $event->NumberOfSeats + $numTicketsReserved]);
        return redirect()->back()->with('success', 'Reservation canceled successfully.');
    }
}

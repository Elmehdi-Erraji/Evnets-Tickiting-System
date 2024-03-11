<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        $usersCount = User::count();
        $eventsCount = Event::count();
        return view ('Admin.users.index',compact('users','eventsCount','usersCount'));
    }

    public function create()
    {
        $roles = Role::all();
        return view ('Admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
      
        $user = User::create($request->all());
        $user->addMediaFromRequest('avatar')->usingName($user->fullName)->toMediaCollection('avatars','avatars');
        $user->roles()->attach($request->role);
        return redirect()->route('users.index')->with('success', 'user created successfully');
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = role::all();
        return view ('Admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $user->roles()->sync($request->role);
        $user->status = $request->status;
    
        if ($request->status == 3 && $request->filled('ban_reason')) {
            $user->ban_reason = $request->input('ban_reason');
        }
    
        $user->save();
        
        return redirect()->route('users.index')->with('success', 'User has been updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success','user deleted successfully');
    }
}

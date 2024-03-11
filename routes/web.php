<?php

use App\Http\Controllers\Admin\EvenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Client\ReservatoinsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Orgonizer\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'index'])->name('home');



Route::middleware(['admin'])->group(function () {
    
    Route::get('/dashboard', [UsersController::class,'index'])->name('dashboard');
    Route::resource('users', UsersController::class);
    Route::resource('category', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('events', EvenController::class);
    Route::put('/events/{event}/restore', [EvenController::class, 'restore'])->name('events.restore');
    Route::delete('/events/force-delete/{id}', [EvenController::class, 'forceDelete'])->name('events.forceDelete');
    
});


Route::middleware(['orgonizer'])->group(function () {
    
    Route::resource('event', EventController::class);
    Route::get('/events/{event}/users/{user}/accept',[ EventController::class,'acceptReservation'])->name('reservation.accept');
    Route::get('/events/{event}/users/{user}/deny',[ EventController::class,'denyReservation'])->name('reservation.deny');
    
});


Route::middleware(['auth'])->group(function(){    
    Route::resource('profile', ProfileController::class);
    Route::delete('/cancel-reservation/{id}', [ProfileController::class, 'cancel'])->name('cancelReservation');
    Route::resource('reservations', ReservatoinsController::class);
    Route::get('get-ticket/{reservationId}', [\App\Http\Controllers\TicketController::class, 'getTicket'])->name('getTicket');
    Route::get('/download-ticket/{reservationId}', [\App\Http\Controllers\TicketController::class, 'downloadTicket'])->name('download.ticket');
    Route::get('ticket', function () {return view('partials.ticket');});
    
});



Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/eventDetails/{id}',  [HomeController::class, 'details'])->name('eventDetails');



require __DIR__.'/auth.php';


//Admin :: test@test.com

//Orgonizer :: organizator@organizator.com

//client ::  client@client.com





// Reservations managment 


// Tickets generating 


// become an orgonizer
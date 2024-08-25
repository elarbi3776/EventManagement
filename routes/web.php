<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MapController;





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

/* -------------- Admin Routes ------------*/

Route::middleware(['auth', 'role:Admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');

    Route::get('/events/comments', [CommentController::class, 'allComments'])->name('comments.index');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('admin/download-pdf', [IndexController::class, 'downloadPdf'])->name('downloadPdf');
    Route::get('admin/download-excel', [IndexController::class, 'downloadExcel'])->name('download.excel');

    Route::get('/comments/{comment}/responses/create', [CommentController::class, 'createResponse'])->name('comments.responses.create');
    Route::post('/comments/{comment}/responses', [CommentController::class, 'storeResponse'])->name('comments.responses.store');



});


/* -------------- Admin Routes ------------*/

/* --------------  Participant Routes ------------*/
Route::middleware(['auth', 'role:Participant'])->name('participant.')->prefix('participant')->group(function () {

    Route::get('/', [ParticipantController::class, 'index'])->name('index');
    Route::get('/participant/events', [EventController::class, 'show'])->name('participant.events.show');
    Route::get('/events/reserve/{event}', [ReservationController::class, 'reserve'])->name('events.reserve');
    Route::get('/tickets/create/{event_id}/{reservation_id}', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/download-ticket/{ticket}', [TicketController::class, 'downloadTicket'])->name('download.ticket');
    Route::post('/events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/events/{event}/comments', [CommentController::class, 'create'])->name('comments.create');
    Route::get('/my-comments', [CommentController::class, 'userComments'])->name('comments');

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');


    Route::get('/notifications/{id}', [NotificationController::class, 'show'])->name('notifications.show');



});    
/* --------------  Participant Routes ------------*/



/* -------------- Organizer Routes ------------*/

Route::middleware(['auth', 'role:Organizer'])->name('organizer.')->prefix('organizer')->group(function () {

    Route::get('/', [OrganizerController::class, 'index'])->name('index');
    Route::resource('events', EventController::class);
    Route::get('/commentsO', [CommentController::class, 'allCommentsO'])->name('comments.org');
    Route::delete('/commentsO/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy.org');

});

/* --------------  Organizer Routes ------------*/

 /* Route::get('/',function(){
    return view('home');
 })->name('home'); */
 
 Route::get('/', [EventController::class, 'home_List'])->name('home');



Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('/dashboard', [EventController::class, 'dashboard_List'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/events/{id}', [EventController::class, 'detail'])->middleware(['auth', 'verified'])->name('events.detail');

Route::get('/calendar', [CalendarController::class, 'index'])->middleware(['auth', 'verified'])->name('calendar.index');
Route::get('/calendar/events', [CalendarController::class, 'events'])->middleware(['auth', 'verified'])->name('calendar.events');

Route::get('/map', [MapController::class, 'index'])->middleware(['auth', 'verified'])->name('map');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');
});



require __DIR__ . '/auth.php';

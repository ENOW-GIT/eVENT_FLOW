<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Organizer\EventController;
use App\Http\Controllers\Organizer\TicketController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\BookerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthentificationController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;




Route::get('/', [FrontendController::class, 'index']);

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/dashboard', function () {
 //   return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/signup', [AuthentificationController::class, 'showSignupForm'])->name('frontend.signup.form');
Route::post('/signup', [AuthentificationController::class, 'signup'])->name('frontend.signup');

Route::get('/signin', [AuthentificationController::class, 'showsigninForm'])->name('frontend.signin.form');
Route::post('/signin', [AuthentificationController::class, 'signin'])->name('frontend.signin');

Route::get('/check-auth', function () {
    return Auth::check() ? "Logged in as: " . Auth::user()->email : "Not logged in";
});

//Route::get('/admin/dashboard', function (): View {
 //   return view('admin.dashboard');
//})->name('admin.dashboard')->middleware('admin');

Route::get('/dashboard', action: [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('organizer/dashboard', [OrganizerController::class, 'index'])->name(name: 'organizer.dashboard');
    Route::get('booker/eventlist', [BookerController::class, 'index'])->name('booker.eventlist');
});

Route::prefix('organizer')->name('organizer.')->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::get('/events/manage', [EventController::class, 'manage'])->name('events.manage');
    Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/view', [EventController::class, 'show'])->name('events.view');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets/store', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/index', [TicketController::class, 'index'])->name('tickets.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
});


Route::get('/home', function () {
    return view('home');
})->name('home');

 
require __DIR__ . '/auth.php';

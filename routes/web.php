<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvitationController as AdminInvitationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Dashboard\InvitationController as DashboardInvitationController;
use App\Http\Controllers\Dashboard\GuestController;
use App\Http\Controllers\InvitationController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/i/{invitation:slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/invitation/{invitation}/guestbook', [GuestMessageController::class, 'store'])->name('guestbook.store');

// Client Routes
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('invitations', DashboardInvitationController::class)->only(['index', 'show']);
        
        // Guest Management for specific invitation
        Route::get('invitations/{invitation}/guests', [GuestController::class, 'index'])->name('guests.index');
        Route::post('invitations/{invitation}/guests', [GuestController::class, 'store'])->name('guests.store');
        Route::delete('invitations/{invitation}/guests/{guest}', [GuestController::class, 'destroy'])->name('guests.destroy');
    });
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('invitations', AdminInvitationController::class);
    Route::resource('users', UserController::class);
    Route::delete('gallery/{gallery}', [AdminInvitationController::class, 'destroyGallery'])->name('gallery.destroy');
});

// General Auth Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

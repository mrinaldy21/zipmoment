<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InvitationController as DashboardInvitationController;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// Public Routes
Route::get('/', function () {
    return view('welcome'); // Future landing page
});

Route::get('/invitation/{invitation:slug}', [InvitationController::class, 'showPublic'])->name('invitation.show');

// Auth & Dashboard Routes (Customer)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('invitations', DashboardInvitationController::class);
        Route::delete('gallery/{gallery}', [DashboardInvitationController::class, 'destroyGallery'])->name('gallery.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Future admin stats
    })->name('dashboard');
    
    Route::resource('invitations', InvitationController::class);
    Route::delete('gallery/{gallery}', [InvitationController::class, 'destroyGallery'])->name('gallery.destroy');
});

Route::get('/test-upload', function (App\Services\CloudinaryService $cloudinary) {
    if (!file_exists(public_path('alffa.jpg'))) {
        return "Please place alffa.jpg in public folder for test.";
    }
    
    $url = $cloudinary->upload(public_path('alffa.jpg'), 'test-production');
    return $url ?: "Upload failed. Check logs.";
});


require __DIR__.'/auth.php';

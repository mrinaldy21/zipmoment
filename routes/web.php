<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\InvitationController as AdminInvitationController;
use App\Http\Controllers\InvitationController as PublicInvitationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.invitations.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/invitations', AdminInvitationController::class, ['as' => 'admin']);
    Route::delete('admin/gallery/{gallery}', [AdminInvitationController::class, 'destroyGallery'])->name('admin.gallery.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-cloudinary', function () {
    return env('CLOUDINARY_URL');
});


require __DIR__.'/auth.php';

// Public Route
Route::get('/{slug}', [PublicInvitationController::class, 'show'])->name('invitation.show');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    switch (auth()->user()->role_id) {
        case 1:
            return redirect()->route('admin.dashboard');
        case 2:
            return redirect()->route('coordinator.dashboard');
        case 3:
            return redirect()->route('client.dashboard');


        default:
            # code...
            break;
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('administrator')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/events', function () {
        return view('admin.event');
    })->name('admin.event');
    Route::get('/coordinator', function () {
        return view('admin.coordinator');
    })->name('admin.coordinator');
    Route::get('/appointments', function () {
        return view('admin.appointments');
    })->name('admin.appointments');
    Route::get('/appointments/{id}', function () {
        return view('admin.appointment-view');
    })->name('admin.appointment-view');
    Route::get('/billing', function () {
        return view('admin.billing');
    })->name('admin.billing');
    Route::get('/records', function () {
        return view('admin.records');
    })->name('admin.records');
    Route::get('/users', function () {
        return view('admin.users');
    })->name('admin.users');
});


Route::prefix('coordinator')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('coordinator.dashboard');
    })->name('coordinator.dashboard');
    Route::get('/appointments', function () {
        return view('coordinator.appointments');
    })->name('coordinator.appointments');


});
Route::prefix('client')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
    Route::get('/appointment', function () {
        return view('client.my-appointment');
    })->name('client.appointment');
    Route::get('/view-appointment', function () {
        return view('client.view-appointment');
    })->name('client.view-appointment');
    Route::get('/appointment/{id}', function () {
        return view('client.appointment');
    })->name('client.get-appointment');
    Route::get('/appointment/edit/{id}', function () {
        return view('client.edit-appointment');
    })->name('client.edit-appointment');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

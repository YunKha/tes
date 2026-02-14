<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\MonitoringController;
use App\Http\Controllers\Admin\TicketController;
use Illuminate\Support\Facades\Route;

// Admin Auth Routes
Route::get('/login', [AuthController::class , 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class , 'login'])->name('admin.login.submit');
Route::get('/register', [AuthController::class , 'showRegister'])->name('admin.register');
Route::post('/register', [AuthController::class , 'register'])->name('admin.register.submit');

// Redirect root to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// Admin Protected Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class , 'logout'])->name('admin.logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class , 'index'])->name('admin.dashboard');

    // Tickets
    Route::get('/tickets', [TicketController::class , 'index'])->name('admin.tickets.index');
    Route::get('/tickets/create', [TicketController::class , 'create'])->name('admin.tickets.create');
    Route::post('/tickets', [TicketController::class , 'store'])->name('admin.tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class , 'show'])->name('admin.tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketController::class , 'edit'])->name('admin.tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class , 'update'])->name('admin.tickets.update');
    Route::delete('/tickets/{ticket}', [TicketController::class , 'destroy'])->name('admin.tickets.destroy');

    // Monitoring
    Route::get('/monitoring', [MonitoringController::class , 'index'])->name('admin.monitoring.index');
    Route::get('/monitoring/{ticket}', [MonitoringController::class , 'show'])->name('admin.monitoring.show');

    // Drivers
    // Drivers
    Route::get('/drivers', [DriverController::class , 'index'])->name('admin.drivers.index');
    Route::get('/drivers/create', [DriverController::class , 'create'])->name('admin.drivers.create');
    Route::post('/drivers', [DriverController::class , 'store'])->name('admin.drivers.store');
    Route::get('/drivers/{driver}', [DriverController::class , 'show'])->name('admin.drivers.show');
    Route::get('/drivers/{driver}/edit', [DriverController::class , 'edit'])->name('admin.drivers.edit');
    Route::put('/drivers/{driver}', [DriverController::class , 'update'])->name('admin.drivers.update');
    Route::delete('/drivers/{driver}', [DriverController::class , 'destroy'])->name('admin.drivers.destroy');
});

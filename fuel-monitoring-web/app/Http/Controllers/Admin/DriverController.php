<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = User::drivers()
            ->withCount(['tickets as total_deliveries' => function ($q) {
            $q->where('status', 'completed');
        }, 'tickets as active_jobs' => function ($q) {
            $q->where('status', 'in_progress');
        }])
            ->orderBy('name')
            ->paginate(15);

        return view('admin.drivers.index', compact('drivers'));
    }

    public function show(User $driver)
    {
        $tickets = $driver->tickets()
            ->with('deliveryPhotos')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.drivers.show', compact('driver', 'tickets'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'nullable|string|max:50',
        ]);

        $validated['role'] = 'driver';
        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Sopir berhasil ditambahkan.');
    }
}

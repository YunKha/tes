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

    public function edit(User $driver)
    {
        if (!$driver->isDriver()) {
            abort(404);
        }
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, User $driver)
    {
        if (!$driver->isDriver()) {
            abort(404);
        }

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $driver->id,
            'phone' => 'nullable|string|max:20',
            'employee_id' => 'nullable|string|max:50',
        ];
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:6';
        }
        $validated = $request->validate($rules);

        $driver->name = $validated['name'];
        $driver->email = $validated['email'];
        $driver->phone = $validated['phone'] ?? null;
        $driver->employee_id = $validated['employee_id'] ?? null;
        if (!empty($validated['password'])) {
            $driver->password = bcrypt($validated['password']);
        }
        $driver->save();

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Data sopir berhasil diperbarui.');
    }

    public function destroy(User $driver)
    {
        if (!$driver->isDriver()) {
            abort(404);
        }
        // Opsional: cek punya tiket aktif
        if ($driver->tickets()->where('status', 'in_progress')->exists()) {
            return redirect()->route('admin.drivers.index')
                ->with('error', 'Sopir masih memiliki job aktif. Batalkan atau selesaikan dulu.');
        }
        $driver->delete();
        return redirect()->route('admin.drivers.index')
            ->with('success', 'Sopir berhasil dihapus.');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('driver');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('lo_number', 'like', "%{$search}%")
                    ->orWhere('spbu_number', 'like', "%{$search}%")
                    ->orWhere('product_type', 'like', "%{$search}%");
            });
        }

        $tickets = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('admin.tickets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lo_number' => 'required|string|max:100',
            'spbu_number' => 'required|string|max:100',
            'ship_to' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'product_type' => 'required|string|max:100',
            'distance_km' => 'required|numeric|min:0',
        ]);

        Ticket::create($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Tiket pengantaran berhasil dibuat.');
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['driver', 'deliveryPhotos']);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'lo_number' => 'required|string|max:100',
            'spbu_number' => 'required|string|max:100',
            'ship_to' => 'required|string|max:100',
            'quantity' => 'required|numeric|min:0',
            'product_type' => 'required|string|max:100',
            'distance_km' => 'required|numeric|min:0',
        ]);

        $ticket->update($validated);

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Tiket pengantaran berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->status !== 'available') {
            return redirect()->route('admin.tickets.index')
                ->with('error', 'Hanya tiket dengan status tersedia yang bisa dihapus.');
        }

        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Tiket pengantaran berhasil dihapus.');
    }
}

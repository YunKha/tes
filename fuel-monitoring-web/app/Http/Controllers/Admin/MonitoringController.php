<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $activeDeliveries = Ticket::with(['driver', 'deliveryPhotos'])
            ->inProgress()
            ->orderBy('taken_at', 'desc')
            ->get();

        $recentCompleted = Ticket::with(['driver', 'deliveryPhotos'])
            ->completed()
            ->orderBy('completed_at', 'desc')
            ->take(20)
            ->get();

        return view('admin.monitoring.index', compact('activeDeliveries', 'recentCompleted'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load(['driver', 'deliveryPhotos']);

        return view('admin.monitoring.show', compact('ticket'));
    }
}

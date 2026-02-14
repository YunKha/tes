<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_tickets' => Ticket::count(),
            'available_tickets' => Ticket::available()->count(),
            'in_progress_tickets' => Ticket::inProgress()->count(),
            'completed_tickets' => Ticket::completed()->count(),
            'total_drivers' => User::drivers()->count(),
        ];

        $recentTickets = Ticket::with('driver')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        $activeDeliveries = Ticket::with(['driver', 'deliveryPhotos'])
            ->inProgress()
            ->orderBy('taken_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('stats', 'recentTickets', 'activeDeliveries'));
    }
}

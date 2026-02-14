@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Grid -->
    <div class="stat-grid">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total_tickets'] }}</h4>
                <p>Total Tiket</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon cyan">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['available_tickets'] }}</h4>
                <p>Tiket Tersedia</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon yellow">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['in_progress_tickets'] }}</h4>
                <p>Sedang Diantar</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['completed_tickets'] }}</h4>
                <p>Selesai</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $stats['total_drivers'] }}</h4>
                <p>Total Sopir</p>
            </div>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
        <!-- Active Deliveries -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-truck" style="color:var(--warning);margin-right:8px;"></i> Pengantaran Aktif</h3>
                <a href="{{ route('admin.monitoring.index') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
            </div>
            <div class="table-container">
                @if($activeDeliveries->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>No. LO</th>
                                <th>SPBU</th>
                                <th>Sopir</th>
                                <th>Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activeDeliveries as $delivery)
                                <tr>
                                    <td><strong>{{ $delivery->lo_number }}</strong></td>
                                    <td>{{ $delivery->spbu_number }}</td>
                                    <td>{{ $delivery->driver_name ?? '-' }}</td>
                                    <td>{{ $delivery->product_type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Tidak ada pengantaran aktif</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Tickets -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-clock" style="color:var(--primary);margin-right:8px;"></i> Tiket Terbaru</h3>
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-secondary">Lihat Semua</a>
            </div>
            <div class="table-container">
                @if($recentTickets->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>No. LO</th>
                                <th>SPBU</th>
                                <th>Produk</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTickets as $ticket)
                                <tr>
                                    <td><strong>{{ $ticket->lo_number }}</strong></td>
                                    <td>{{ $ticket->spbu_number }}</td>
                                    <td>{{ $ticket->product_type }}</td>
                                    <td><span class="badge badge-{{ $ticket->status }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <p>Belum ada tiket</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

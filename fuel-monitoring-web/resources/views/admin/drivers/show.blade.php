@extends('admin.layouts.app')

@section('page-title', 'Detail Sopir - ' . $driver->name)

@section('content')
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.drivers.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <!-- Driver Info -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h3><i class="fas fa-user" style="color:var(--primary);margin-right:8px;"></i> Profil Sopir</h3>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="label">Nama</div>
                    <div class="value">{{ $driver->name }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Email</div>
                    <div class="value">{{ $driver->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Telepon</div>
                    <div class="value">{{ $driver->phone ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">ID Karyawan</div>
                    <div class="value">{{ $driver->employee_id ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Driver Deliveries -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-history" style="color:var(--info);margin-right:8px;"></i> Riwayat Pengantaran</h3>
        </div>
        <div class="table-container">
            @if($tickets->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No. LO</th>
                            <th>SPBU</th>
                            <th>Produk</th>
                            <th>Jumlah (L)</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td><strong>{{ $ticket->lo_number }}</strong></td>
                                <td>{{ $ticket->spbu_number }}</td>
                                <td>{{ $ticket->product_type }}</td>
                                <td>{{ number_format($ticket->quantity, 0, ',', '.') }}</td>
                                <td><span class="badge badge-{{ $ticket->status }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span></td>
                                <td>{{ $ticket->taken_at?->format('d M Y') ?? $ticket->created_at->format('d M Y') }}</td>
                                <td><span class="badge badge-completed">{{ $ticket->deliveryPhotos->count() }} foto</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h4>Belum ada riwayat pengantaran</h4>
                </div>
            @endif
        </div>
        @if($tickets->hasPages())
            <div class="pagination-wrapper">
                {{ $tickets->links() }}
            </div>
        @endif
    </div>
@endsection

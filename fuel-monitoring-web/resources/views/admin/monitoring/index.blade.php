@extends('admin.layouts.app')

@section('page-title', 'Monitoring Pengantaran')

@section('content')
    <!-- Active Deliveries -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h3><i class="fas fa-satellite-dish" style="color:var(--warning);margin-right:8px;"></i> Pengantaran Aktif</h3>
            <span class="badge badge-in_progress">{{ $activeDeliveries->count() }} Aktif</span>
        </div>
        <div class="table-container">
            @if($activeDeliveries->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No. LO</th>
                            <th>SPBU</th>
                            <th>Produk</th>
                            <th>Jumlah (L)</th>
                            <th>Sopir</th>
                            <th>No. Karnet</th>
                            <th>Diambil</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeDeliveries as $delivery)
                            <tr>
                                <td><strong>{{ $delivery->lo_number }}</strong></td>
                                <td>{{ $delivery->spbu_number }}</td>
                                <td>{{ $delivery->product_type }}</td>
                                <td>{{ number_format($delivery->quantity, 0, ',', '.') }}</td>
                                <td>{{ $delivery->driver_name ?? '-' }}</td>
                                <td>{{ $delivery->karnet_number ?? '-' }}</td>
                                <td>{{ $delivery->taken_at?->format('d M Y, H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.monitoring.show', $delivery) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-truck"></i>
                    <h4>Tidak ada pengantaran aktif</h4>
                    <p>Semua pengantaran sudah selesai atau belum ada tiket yang diambil</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Completed -->
    <div class="card">
        <div class="card-header">
            <h3><i class="fas fa-check-double" style="color:var(--success);margin-right:8px;"></i> Pengantaran Selesai (Terbaru)</h3>
        </div>
        <div class="table-container">
            @if($recentCompleted->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No. LO</th>
                            <th>SPBU</th>
                            <th>Produk</th>
                            <th>Jumlah (L)</th>
                            <th>Sopir</th>
                            <th>Selesai</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentCompleted as $delivery)
                            <tr>
                                <td><strong>{{ $delivery->lo_number }}</strong></td>
                                <td>{{ $delivery->spbu_number }}</td>
                                <td>{{ $delivery->product_type }}</td>
                                <td>{{ number_format($delivery->quantity, 0, ',', '.') }}</td>
                                <td>{{ $delivery->driver_name ?? '-' }}</td>
                                <td>{{ $delivery->completed_at?->format('d M Y, H:i') }}</td>
                                <td>
                                    <span class="badge badge-completed">{{ $delivery->deliveryPhotos->count() }} foto</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.monitoring.show', $delivery) }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-clipboard-check"></i>
                    <h4>Belum ada pengantaran selesai</h4>
                </div>
            @endif
        </div>
    </div>
@endsection

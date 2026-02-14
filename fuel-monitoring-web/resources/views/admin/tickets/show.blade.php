@extends('admin.layouts.app')

@section('page-title', 'Detail Tiket #' . $ticket->lo_number)

@section('content')
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali ke Daftar</a>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
        <!-- Ticket Info -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-info-circle" style="color:var(--primary);margin-right:8px;"></i> Informasi Tiket</h3>
                <span class="badge badge-{{ $ticket->status }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span>
            </div>
            <div class="card-body">
                <div class="detail-grid">
                    <div class="detail-item">
                        <div class="label">Nomor LO</div>
                        <div class="value">{{ $ticket->lo_number }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Nomor SPBU</div>
                        <div class="value">{{ $ticket->spbu_number }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Nomor Ship To</div>
                        <div class="value">{{ $ticket->ship_to }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Jumlah KL/DO</div>
                        <div class="value">{{ number_format($ticket->quantity, 0, ',', '.') }} Liter</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Jenis Produk</div>
                        <div class="value">{{ $ticket->product_type }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Jarak Tempuh</div>
                        <div class="value">{{ $ticket->distance_km }} km</div>
                    </div>
                    <div class="detail-item">
                        <div class="label">Dibuat</div>
                        <div class="value">{{ $ticket->created_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Info -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-user" style="color:var(--success);margin-right:8px;"></i> Informasi Sopir</h3>
            </div>
            <div class="card-body">
                @if($ticket->driver_name)
                    <div class="detail-grid">
                        <div class="detail-item">
                            <div class="label">Nama Sopir</div>
                            <div class="value">{{ $ticket->driver_name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="label">Nomor Karnet</div>
                            <div class="value">{{ $ticket->karnet_number }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="label">Diambil Pada</div>
                            <div class="value">{{ $ticket->taken_at?->format('d M Y, H:i') ?? '-' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="label">Selesai Pada</div>
                            <div class="value">{{ $ticket->completed_at?->format('d M Y, H:i') ?? '-' }}</div>
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-user-slash"></i>
                        <p>Belum ada sopir yang mengambil tiket ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Photos -->
    @if($ticket->deliveryPhotos->count() > 0)
        <div class="card" style="margin-top:24px;">
            <div class="card-header">
                <h3><i class="fas fa-camera" style="color:var(--info);margin-right:8px;"></i> Dokumentasi Foto</h3>
            </div>
            <div class="card-body">
                <div class="photo-grid">
                    @foreach($ticket->deliveryPhotos as $photo)
                        <div class="photo-card">
                            <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto {{ $photo->photo_type }}">
                            <div class="photo-meta">
                                <p><strong>
                                    <span class="badge badge-{{ $photo->photo_type === 'checkin' ? 'available' : 'completed' }}">
                                        {{ $photo->photo_type === 'checkin' ? 'Check-In' : 'Check-Out' }}
                                    </span>
                                </strong></p>
                                <p><i class="fas fa-map-marker-alt"></i> {{ $photo->latitude }}, {{ $photo->longitude }}</p>
                                @if($photo->address)
                                    <p><i class="fas fa-location-dot"></i> {{ $photo->address }}</p>
                                @endif
                                <p><i class="fas fa-clock"></i> {{ $photo->photo_taken_at?->format('d M Y, H:i:s') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection

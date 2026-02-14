@extends('admin.layouts.app')

@section('page-title', 'Detail Monitoring - ' . $ticket->lo_number)

@section('content')
    <div style="margin-bottom:20px;">
        <a href="{{ route('admin.monitoring.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <!-- Ticket Summary -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header">
            <h3><i class="fas fa-info-circle" style="color:var(--primary);margin-right:8px;"></i> Ringkasan Pengantaran</h3>
            <span class="badge badge-{{ $ticket->status }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="label">Nomor LO</div>
                    <div class="value">{{ $ticket->lo_number }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">SPBU Tujuan</div>
                    <div class="value">{{ $ticket->spbu_number }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Produk</div>
                    <div class="value">{{ $ticket->product_type }} - {{ number_format($ticket->quantity, 0, ',', '.') }} L</div>
                </div>
                <div class="detail-item">
                    <div class="label">Sopir</div>
                    <div class="value">{{ $ticket->driver_name ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">No. Karnet</div>
                    <div class="value">{{ $ticket->karnet_number ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Jarak</div>
                    <div class="value">{{ $ticket->distance_km }} km</div>
                </div>
                <div class="detail-item">
                    <div class="label">Waktu Ambil</div>
                    <div class="value">{{ $ticket->taken_at?->format('d M Y, H:i:s') ?? '-' }}</div>
                </div>
                <div class="detail-item">
                    <div class="label">Waktu Selesai</div>
                    <div class="value">{{ $ticket->completed_at?->format('d M Y, H:i:s') ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Timeline Photos -->
    @php
        $checkinPhotos = $ticket->deliveryPhotos->where('photo_type', 'checkin');
        $checkoutPhotos = $ticket->deliveryPhotos->where('photo_type', 'checkout');
    @endphp

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">
        <!-- Check-in -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt" style="color:var(--primary);margin-right:8px;"></i> Foto Check-In</h3>
            </div>
            <div class="card-body">
                @if($checkinPhotos->count() > 0)
                    <div class="photo-grid" style="grid-template-columns:1fr;">
                        @foreach($checkinPhotos as $photo)
                            <div class="photo-card">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Check-in">
                                <div class="photo-meta">
                                    <p><i class="fas fa-map-marker-alt" style="color:var(--danger);"></i> {{ $photo->latitude }}, {{ $photo->longitude }}</p>
                                    @if($photo->address)
                                        <p><i class="fas fa-location-dot"></i> {{ $photo->address }}</p>
                                    @endif
                                    <p><i class="fas fa-clock" style="color:var(--primary);"></i> {{ $photo->photo_taken_at?->format('d M Y, H:i:s') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-camera-retro"></i>
                        <p>Belum ada foto check-in</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Check-out -->
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-out-alt" style="color:var(--success);margin-right:8px;"></i> Foto Check-Out</h3>
            </div>
            <div class="card-body">
                @if($checkoutPhotos->count() > 0)
                    <div class="photo-grid" style="grid-template-columns:1fr;">
                        @foreach($checkoutPhotos as $photo)
                            <div class="photo-card">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Check-out">
                                <div class="photo-meta">
                                    <p><i class="fas fa-map-marker-alt" style="color:var(--danger);"></i> {{ $photo->latitude }}, {{ $photo->longitude }}</p>
                                    @if($photo->address)
                                        <p><i class="fas fa-location-dot"></i> {{ $photo->address }}</p>
                                    @endif
                                    <p><i class="fas fa-clock" style="color:var(--primary);"></i> {{ $photo->photo_taken_at?->format('d M Y, H:i:s') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-camera-retro"></i>
                        <p>Belum ada foto check-out</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('page-title', 'Tiket Pengantaran')

@section('content')
    <div class="filter-bar">
        <form method="GET" action="{{ route('admin.tickets.index') }}" style="display:flex;gap:12px;flex-wrap:wrap;align-items:center;width:100%;">
            <input type="text" name="search" class="form-control" placeholder="Cari No. LO, SPBU, Produk..."
                   value="{{ request('search') }}" style="min-width:250px;">
            <select name="status" class="form-control" style="min-width:160px;">
                <option value="">Semua Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Sedang Diantar</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
            </select>
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-search"></i> Filter</button>
            <div style="margin-left:auto;">
                <a href="{{ route('admin.tickets.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Buat Tiket Baru
                </a>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="table-container">
            @if($tickets->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>No. LO</th>
                            <th>No. SPBU</th>
                            <th>Ship To</th>
                            <th>Jumlah (L)</th>
                            <th>Produk</th>
                            <th>Jarak</th>
                            <th>Sopir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tickets as $ticket)
                            <tr>
                                <td><strong>{{ $ticket->lo_number }}</strong></td>
                                <td>{{ $ticket->spbu_number }}</td>
                                <td>{{ $ticket->ship_to }}</td>
                                <td>{{ number_format($ticket->quantity, 0, ',', '.') }}</td>
                                <td>{{ $ticket->product_type }}</td>
                                <td>{{ $ticket->distance_km }} km</td>
                                <td>{{ $ticket->driver_name ?? '-' }}</td>
                                <td><span class="badge badge-{{ $ticket->status }}">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span></td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-icon btn-secondary" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($ticket->status === 'available')
                                            <a href="{{ route('admin.tickets.edit', $ticket) }}" class="btn btn-icon btn-secondary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.tickets.destroy', $ticket) }}" style="display:inline;"
                                                  onsubmit="return confirm('Yakin ingin menghapus tiket ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-ticket-alt"></i>
                    <h4>Belum ada tiket pengantaran</h4>
                    <p>Buat tiket baru untuk memulai</p>
                </div>
            @endif
        </div>
        @if($tickets->hasPages())
            <div class="pagination-wrapper">
                {{ $tickets->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection

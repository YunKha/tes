@extends('admin.layouts.app')

@section('page-title', 'Edit Tiket Pengantaran')

@section('content')
    <div class="card" style="max-width:700px;">
        <div class="card-header">
            <h3><i class="fas fa-edit" style="color:var(--primary);margin-right:8px;"></i> Edit Tiket</h3>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.tickets.update', $ticket) }}">
                @csrf
                @method('PUT')
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 20px;">
                    <div class="form-group">
                        <label for="lo_number">Nomor LO *</label>
                        <input type="text" id="lo_number" name="lo_number" class="form-control @error('lo_number') is-invalid @enderror"
                               value="{{ old('lo_number', $ticket->lo_number) }}" required>
                        @error('lo_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="spbu_number">Nomor SPBU *</label>
                        <input type="text" id="spbu_number" name="spbu_number" class="form-control @error('spbu_number') is-invalid @enderror"
                               value="{{ old('spbu_number', $ticket->spbu_number) }}" required>
                        @error('spbu_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="ship_to">Nomor Ship To *</label>
                        <input type="text" id="ship_to" name="ship_to" class="form-control @error('ship_to') is-invalid @enderror"
                               value="{{ old('ship_to', $ticket->ship_to) }}" required>
                        @error('ship_to')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah KL/DO (Liter) *</label>
                        <input type="number" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity', $ticket->quantity) }}" step="0.01" required>
                        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="product_type">Jenis Produk *</label>
                        <select id="product_type" name="product_type" class="form-control @error('product_type') is-invalid @enderror" required>
                            @foreach(['Pertalite', 'Pertamax', 'Pertamax Turbo', 'Pertamina Dex', 'Solar', 'Bio Solar'] as $product)
                                <option value="{{ $product }}" {{ old('product_type', $ticket->product_type) == $product ? 'selected' : '' }}>{{ $product }}</option>
                            @endforeach
                        </select>
                        @error('product_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="distance_km">Jarak Tempuh (km) *</label>
                        <input type="number" id="distance_km" name="distance_km" class="form-control @error('distance_km') is-invalid @enderror"
                               value="{{ old('distance_km', $ticket->distance_km) }}" step="0.01" required>
                        @error('distance_km')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div style="display:flex;gap:12px;margin-top:12px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Perbarui Tiket</button>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('page-title', 'Buat Tiket Pengantaran')

@section('content')
    <div class="card" style="max-width:700px;">
        <div class="card-header">
            <h3><i class="fas fa-plus-circle" style="color:var(--primary);margin-right:8px;"></i> Form Tiket Baru</h3>
            <a href="{{ route('admin.tickets.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.tickets.store') }}">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 20px;">
                    <div class="form-group">
                        <label for="lo_number">Nomor LO *</label>
                        <input type="text" id="lo_number" name="lo_number" class="form-control @error('lo_number') is-invalid @enderror"
                               value="{{ old('lo_number') }}" placeholder="Contoh: LO-2024-001" required>
                        @error('lo_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="spbu_number">Nomor SPBU *</label>
                        <input type="text" id="spbu_number" name="spbu_number" class="form-control @error('spbu_number') is-invalid @enderror"
                               value="{{ old('spbu_number') }}" placeholder="Contoh: 34.401.01" required>
                        @error('spbu_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ship_to">Nomor Ship To *</label>
                        <input type="text" id="ship_to" name="ship_to" class="form-control @error('ship_to') is-invalid @enderror"
                               value="{{ old('ship_to') }}" placeholder="Contoh: 1234567" required>
                        @error('ship_to')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah KL/DO (Liter) *</label>
                        <input type="number" id="quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity') }}" placeholder="Contoh: 8000" step="0.01" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_type">Jenis Produk *</label>
                        <select id="product_type" name="product_type" class="form-control @error('product_type') is-invalid @enderror" required>
                            <option value="">Pilih Produk</option>
                            <option value="Pertalite" {{ old('product_type') == 'Pertalite' ? 'selected' : '' }}>Pertalite</option>
                            <option value="Pertamax" {{ old('product_type') == 'Pertamax' ? 'selected' : '' }}>Pertamax</option>
                            <option value="Pertamax Turbo" {{ old('product_type') == 'Pertamax Turbo' ? 'selected' : '' }}>Pertamax Turbo</option>
                            <option value="Pertamina Dex" {{ old('product_type') == 'Pertamina Dex' ? 'selected' : '' }}>Pertamina Dex</option>
                            <option value="Solar" {{ old('product_type') == 'Solar' ? 'selected' : '' }}>Solar</option>
                            <option value="Bio Solar" {{ old('product_type') == 'Bio Solar' ? 'selected' : '' }}>Bio Solar</option>
                        </select>
                        @error('product_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="distance_km">Jarak Tempuh (km) *</label>
                        <input type="number" id="distance_km" name="distance_km" class="form-control @error('distance_km') is-invalid @enderror"
                               value="{{ old('distance_km') }}" placeholder="Contoh: 32" step="0.01" required>
                        @error('distance_km')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display:flex;gap:12px;margin-top:12px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Tiket</button>
                    <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection

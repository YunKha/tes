@extends('admin.layouts.app')

@section('page-title', 'Edit Sopir')

@section('content')
    <div class="card" style="max-width:600px;">
        <div class="card-header">
            <h3><i class="fas fa-user-edit" style="color:var(--primary);margin-right:8px;"></i> Form Edit Sopir</h3>
            <a href="{{ route('admin.drivers.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.drivers.update', $driver) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', $driver->name) }}" placeholder="Nama sopir" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $driver->email) }}" placeholder="email@example.com" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label for="password">Password (kosongkan jika tidak diubah)</label>
                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                           placeholder="Minimal 6 karakter">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:0 20px;">
                    <div class="form-group">
                        <label for="phone">Telepon</label>
                        <input type="text" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone', $driver->phone) }}" placeholder="08xxxxxxxxxx">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="employee_id">ID Karyawan</label>
                        <input type="text" id="employee_id" name="employee_id" class="form-control @error('employee_id') is-invalid @enderror"
                               value="{{ old('employee_id', $driver->employee_id) }}" placeholder="DRV001">
                        @error('employee_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div style="display:flex;gap:12px;margin-top:12px;">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
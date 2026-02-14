@extends('admin.layouts.app')

@section('page-title', 'Data Sopir')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
        <h3 style="font-size:16px;color:var(--gray-500);">Total {{ $drivers->total() }} Sopir Terdaftar</h3>
        <a href="{{ route('admin.drivers.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Tambah Sopir
        </a>
    </div>

    <div class="card">
        <div class="table-container">
            @if($drivers->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Telepon</th>
                            <th>ID Karyawan</th>
                            <th>Pengantaran Selesai</th>
                            <th>Job Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drivers as $driver)
                            <tr>
                                <td><strong>{{ $driver->name }}</strong></td>
                                <td>{{ $driver->email }}</td>
                                <td>{{ $driver->phone ?? '-' }}</td>
                                <td>{{ $driver->employee_id ?? '-' }}</td>
                                <td><span class="badge badge-completed">{{ $driver->total_deliveries }}</span></td>
                                <td>
                                    @if($driver->active_jobs > 0)
                                        <span class="badge badge-in_progress">{{ $driver->active_jobs }}</span>
                                    @else
                                        <span style="color:var(--gray-400);">0</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.drivers.show', $driver) }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" class="inline-form" style="display:inline;" onsubmit="return confirm('Yakin hapus sopir {{ $driver->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h4>Belum ada sopir terdaftar</h4>
                    <p>Tambah sopir baru untuk memulai</p>
                </div>
            @endif
        </div>
        @if($drivers->hasPages())
            <div class="pagination-wrapper">
                {{ $drivers->links() }}
            </div>
        @endif
    </div>
@endsection

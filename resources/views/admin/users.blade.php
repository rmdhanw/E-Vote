@extends('layouts.admin')

@section('content')
{{-- w --}}

<div class="row mb-4 mt-2">
    <div class="col-12">
        <h2 class="fw-bold text-danger border-bottom border-danger pb-2">Manajemen Akun</h2>
        <p class="text-muted">Kelola akun Admin dan Device (Bilik Suara) yang dapat mengakses sistem.</p>
    </div>
</div>

<!-- Success Notif -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-white" style="border-left: 5px solid #198754 !important;" role="alert">
        <strong><i class="fa-solid fa-circle-check text-success me-2"></i>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Error Notif -->
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 bg-white" style="border-left: 5px solid #dc3545 !important;" role="alert">
        <strong><i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>Ups! Ada kesalahan:</strong>
        <ul class="mb-0 mt-2 text-muted">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <!-- Add Acc Form -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-lg rounded-4 border-0">
            <div class="card-header bg-red-gradient rounded-top-4 py-3">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-user-plus me-2"></i>Tambah Akun Baru</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold text-dark">Nama Pengguna</label>
                        <input type="text" name="name" id="name" class="form-control bg-light" required placeholder="Contoh: Bilik Suara 2" value="{{ old('name') }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold text-dark">Alamat Email</label>
                        <input type="email" name="email" id="email" class="form-control bg-light" required placeholder="bilik2@rt.com" value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold text-dark">Password</label>
                        <input type="password" name="password" id="password" class="form-control bg-light" required placeholder="Minimal 6 karakter">
                    </div>

                    <div class="mb-4">
                        <label for="role" class="form-label fw-bold text-dark">Peran (Role)</label>
                        <select name="role" id="role" class="form-select bg-light" required>
                            <option value="device">Bilik Suara (Device)</option>
                            <option value="admin">Administrator</option>
                        </select>
                        <div class="form-text mt-2 small">
                            <i class="fa-solid fa-circle-info text-primary"></i> <b>Admin</b> mengakses dashboard. <br><b>Bilik Suara</b> mengakses form pemilihan.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-red btn-lg w-100 fw-bold py-2 shadow-sm">
                        Simpan Akun <i class="fa-solid fa-floppy-disk ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Acc List Table -->
    <div class="col-md-8">
        <div class="card shadow-lg rounded-4 overflow-hidden border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead class="bg-red-gradient">
                            <tr>
                                <th class="py-3 text-white border-0">No</th>
                                <th class="py-3 text-white border-0 text-start">Nama & Email</th>
                                <th class="py-3 text-white border-0">Role</th>
                                <th class="py-3 text-white border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($users as $index => $user)
                            <tr>
                                <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                <td class="text-start">
                                    <div class="fw-bold fs-6 text-dark">{{ $user->name }}</div>
                                    <div class="text-muted small">{{ $user->email }}</div>
                                </td>
                                <td>
                                    @if($user->role == 'admin')
                                        <span class="badge bg-danger rounded-pill px-3 py-2"><i class="fa-solid fa-crown me-1"></i> Admin</span>
                                    @else
                                        <span class="badge bg-primary rounded-pill px-3 py-2"><i class="fa-solid fa-laptop me-1"></i> Bilik Suara</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $user->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3 shadow-sm" {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                            <i class="fa-solid fa-trash-can me-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

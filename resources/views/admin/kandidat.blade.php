@extends('layouts.admin')

@section('content')

<div class="row mb-4 mt-2">
    <div class="col-12">
        <h2 class="fw-bold text-danger border-bottom border-danger pb-2">Manajemen Kandidat</h2>
        <p class="text-muted">Kelola kandidat yang akan tampil di layar bilik suara.</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-white" style="border-left: 5px solid #198754 !important;" role="alert">
        <strong><i class="fa-solid fa-circle-check text-success me-2"></i>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
    <div class="col-md-4 mb-4">
        <div class="card shadow-lg rounded-4">
            <div class="card-header bg-red-gradient rounded-top-4 py-3">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-user-plus me-2"></i>Tambah Kandidat</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.kandidat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold text-dark">Nama Lengkap Kandidat</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg bg-light" required placeholder="Contoh: Budi Santoso" value="{{ old('name') }}">
                    </div>

                    <div class="mb-4">
                        <label for="photo" class="form-label fw-bold text-dark">Foto Kandidat</label>
                        <input type="file" name="photo" id="photo" class="form-control bg-light" accept="image/jpeg, image/png, image/jpg" required>
                        <div class="form-text text-muted small mt-2">
                            <i class="fa-solid fa-circle-info me-1"></i>Format awal: JPG/PNG (Maks: 2MB).<br>
                            Sistem akan otomatis mengompresi gambar ke <b>WebP</b>.
                        </div>
                    </div>

                    <button type="submit" class="btn btn-red btn-lg w-100 fw-bold py-2 shadow-sm">
                        Simpan Kandidat <i class="fa-solid fa-floppy-disk ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead class="bg-red-gradient">
                            <tr>
                                <th class="py-3 text-white border-0">No</th>
                                <th class="py-3 text-white border-0">Foto</th>
                                <th class="py-3 text-white border-0 text-start">Nama Kandidat</th>
                                <th class="py-3 text-white border-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($candidates as $index => $kandidat)
                            <tr>
                                <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                <td class="py-3">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/' . $kandidat->photo) }}" alt="Foto {{ $kandidat->name }}"
                                             class="rounded-circle shadow-sm border border-2 border-danger" style="width: 75px; height: 75px; object-fit: cover;">
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 0.6rem;">
                                            WebP
                                        </span>
                                    </div>
                                </td>
                                <td class="text-start fw-bold fs-5 text-dark">{{ $kandidat->name }}</td>
                                <td>
                                    <form action="{{ route('admin.kandidat.destroy', $kandidat->id) }}" method="POST"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kandidat {{ $kandidat->name }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3 shadow-sm">
                                            <i class="fa-solid fa-trash-can me-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-muted py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <i class="fa-solid fa-folder-open display-4 mb-3 text-secondary" style="opacity: 0.5;"></i>
                                        <i class="fs-5">Belum ada data kandidat. Silakan tambahkan dari form di sebelah kiri.</i>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

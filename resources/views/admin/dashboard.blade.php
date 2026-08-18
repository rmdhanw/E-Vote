@extends('layouts.admin')

@section('content')
<div class="row mb-5 mt-2 justify-content-center">
    <div class="col-md-8 text-center">
        <h2 class="fw-bold text-danger mb-3">Dashboard Pemilihan</h2>
        <p class="text-muted fs-5">Pantau total partisipasi warga secara langsung dari bilik suara.</p>
    </div>
</div>

<div class="row justify-content-center">
    <!-- Total Votes Card -->
    <div class="col-md-8 col-lg-6 mb-4">
        <div class="card shadow-lg text-white text-center border-0 rounded-4" style="background: linear-gradient(135deg, #d32f2f, #e53935);">
            <div class="card-body py-5">
                <i class="fa-solid fa-users display-4 mb-3" style="opacity: 0.8;"></i>
                <h4 class="text-uppercase tracking-wide mb-3 fw-light">Total Suara Masuk</h4>

                <!-- Votes Value -->
                <h1 class="display-1 fw-bold mb-0" style="font-size: 6rem; text-shadow: 2px 4px 10px rgba(0,0,0,0.2);">
                    {{ $totalVotes }}
                </h1>

                <p class="mt-4 mb-0 fs-6" style="opacity: 0.9;">
                    <i class="fa-solid fa-circle-check me-1"></i> Data diperbarui secara real-time
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

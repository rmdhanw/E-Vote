@extends('layouts.admin')

@section('content')

<!-- Header & Action Button -->
<div class="row mb-4 mt-2 align-items-end">
    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
        <h2 class="fw-bold text-danger border-bottom border-danger pb-2 d-inline-block">Hasil Pemilihan</h2>
        <p class="text-muted mb-0 mt-2">Laporan persentase dan rincian data pemilih.</p>
    </div>
    <div class="col-md-6 text-center text-md-end">
        <!-- Export CSV Button -->
        <a href="{{ route('admin.hasil.export') }}" class="btn btn-success fw-bold rounded-pill shadow-sm px-4 me-2">
            <i class="fa-solid fa-file-csv me-1"></i> Export Data
        </a>

        <!-- Reset Data Button -->
        <form action="{{ route('admin.hasil.reset') }}" method="POST" class="d-inline-block"
              onsubmit="return confirm('PERINGATAN! Anda yakin ingin MENGHAPUS SELURUH DATA SUARA? Data yang dihapus tidak dapat dikembalikan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger fw-bold rounded-pill shadow-sm px-4">
                <i class="fa-solid fa-trash-can me-1"></i> Reset Suara
            </button>
        </form>
    </div>
</div>

<!-- Success Message -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-white" style="border-left: 5px solid #198754 !important;" role="alert">
        <strong><i class="fa-solid fa-circle-check text-success me-2"></i>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Chart -->
<div class="row justify-content-center mb-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-red-gradient py-3">
                <h5 class="mb-0 fw-bold text-center"><i class="fa-solid fa-chart-pie me-2"></i>Persentase Perolehan Suara</h5>
            </div>
            <div class="card-body p-4 d-flex justify-content-center">
                @if($totalVotes > 0)
                    <div style="width: 100%; max-width: 380px;">
                        <canvas id="hasilChart"></canvas>
                    </div>
                @else
                    <div class="text-center py-5 w-100">
                        <i class="fa-solid fa-box-open display-3 text-muted mb-3" style="opacity: 0.3;"></i>
                        <h5 class="text-muted">Belum ada suara yang masuk.</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Vote Data -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
            <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-0 fw-bold"><i class="fa-solid fa-list-check me-2"></i>Detail Data Pemilih</h5>

                <button class="btn btn-sm btn-light text-danger fw-bold rounded-pill shadow-sm mt-2 mt-md-0 px-3" onclick="togglePrivacy()" id="btnToggle">
                    <i class="fa-solid fa-eye me-1"></i> Tampilkan Data
                </button>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 border-0">No</th>
                                <th class="py-3 border-0">Waktu Memilih</th>
                                <th class="py-3 border-0 text-start">Nama Pemilih</th>
                                <th class="py-3 border-0">Pilihan Kandidat</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @forelse($votesData as $index => $vote)
                            <tr>
                                <td class="fw-bold text-muted">{{ $index + 1 }}</td>
                                <td class="text-muted small">{{ $vote->created_at->format('d M Y, H:i') }}</td>

                                <td class="text-start fw-bold text-dark data-rahasia fs-6">{{ $vote->voter_name }}</td>

                                <td class="data-rahasia">
                                    @if($vote->candidate_id)
                                        <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm">{{ $vote->candidate->name }}</span>
                                    @else
                                        <span class="badge bg-secondary rounded-pill px-3 py-2 shadow-sm">Kotak Kosong</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-muted py-5 text-center">
                                    <i>Data pemilihan masih kosong.</i>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let isHidden = true;
    function togglePrivacy() {
        const elements = document.querySelectorAll('.data-rahasia');
        const btn = document.getElementById('btnToggle');

        if(isHidden) {
            elements.forEach(el => el.classList.add('revealed'));
            btn.innerHTML = '<i class="fa-solid fa-eye-slash me-1"></i> Sembunyikan Data';
            btn.classList.replace('text-danger', 'text-dark');
            isHidden = false;
        } else {
            elements.forEach(el => el.classList.remove('revealed'));
            btn.innerHTML = '<i class="fa-solid fa-eye me-1"></i> Tampilkan Data';
            btn.classList.replace('text-dark', 'text-danger');
            isHidden = true;
        }
    }

    @if($totalVotes > 0)
        const ctx = document.getElementById('hasilChart').getContext('2d');
        const chartData = @json($chartData);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.data,
                    backgroundColor: chartData.backgroundColor,
                    borderWidth: 3,
                    borderColor: '#ffffff',
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: { family: "'Segoe UI', sans-serif", size: 13 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                let value = context.raw || 0;
                                let total = context.chart._metasets[context.datasetIndex].total;
                                let percentage = total > 0 ? Math.round((value / total) * 100) : 0;

                                return ` ${label}: ${value} Suara (${percentage}%)`;
                            }
                        },
                        padding: 12,
                        titleFont: { size: 14 },
                        bodyFont: { size: 14 }
                    }
                }
            }
        });
    @endif
</script>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilik Suara - Pemilihan RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pemilihan.css') }}">
</head>
<body>

    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <div class="mb-3">
                <i class="fa-solid fa-check-to-slot text-danger" style="font-size: 3rem; opacity: 0.9;"></i>
            </div>
            <h1 class="fw-bold text-uppercase header-title">Pemilihan Ketua RT</h1>
            <h4 class="text-secondary fw-bold">Masa Jabatan 2026 - 2031</h4>
            <p class="lead mb-0 mt-3 text-dark">Desa Sambibulu, Dusun Sambiroto RT 17 RW 03</p>
            <p class="lead text-dark">Kecamatan Taman, Kabupaten Sidoarjo</p>
            <hr class="w-25 mx-auto border-danger opacity-50 mt-4" style="border-width: 3px;">
        </div>

        <form action="{{ route('pemilihan.store') }}" method="POST" id="formPemilihan">
            @csrf

            <!-- Input Voters Name -->
            <div class="row justify-content-center mb-5">
                <div class="col-md-7">
                    <div class="card shadow-lg border-0 rounded-4" style="border-top: 5px solid #d32f2f !important;">
                        <div class="card-body p-4 p-md-5 text-center bg-white">
                            <label for="voter_name" class="form-label fw-bold fs-4 mb-3 text-dark">
                                <i class="fa-solid fa-id-card text-danger me-2"></i>Masukkan Nama Lengkap Anda
                            </label>
                            <input type="text" name="voter_name" id="voter_name" class="form-control form-control-lg text-center bg-light border-0 shadow-sm py-3 fs-5"
                                   required placeholder="Contoh: Cahyo Yuliono" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Candidate Options -->
            <h3 class="text-center fw-bold mb-4 text-secondary">Silakan Tentukan Pilihan Anda</h3>
            <div class="row justify-content-center">

                <!-- Get Candidates from Database -->
                @foreach($candidates as $kandidat)
                <div class="col-md-4 mb-4">
                    <label class="w-100 h-100">
                        <input type="radio" name="candidate_id" value="{{ $kandidat->id }}" required>
                        <div class="card shadow-sm candidate-card h-100 rounded-4">
                            <div class="card-body text-center p-4">
                                <img src="{{ asset('storage/' . $kandidat->photo) }}" alt="{{ $kandidat->name }}"
                                     class="img-fluid rounded-circle mb-4 shadow"
                                     style="width: 220px; height: 220px; object-fit: cover; border: 3px solid #f8f9fa;">
                                <h3 class="fw-bold text-dark">{{ $kandidat->name }}</h3>
                                <div class="mt-3 text-danger check-indicator" style="opacity: 0; transition: 0.3s;">
                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
                @endforeach

                <!-- Blank Option -->
                <div class="col-md-4 mb-4">
                    <label class="w-100 h-100">
                        <input type="radio" name="candidate_id" value="" required>
                        <div class="card shadow-sm candidate-card h-100 rounded-4">
                            <div class="card-body text-center p-4 d-flex flex-column justify-content-center align-items-center" style="min-height: 350px;">
                                <div class="bg-secondary rounded-circle d-flex justify-content-center align-items-center mb-4 shadow"
                                     style="width: 220px; height: 220px; border: 3px solid #f8f9fa;">
                                    <i class="fa-solid fa-box-open text-white display-1"></i>
                                </div>
                                <h3 class="fw-bold text-dark">Kotak Kosong</h3>
                                <div class="mt-3 text-danger check-indicator" style="opacity: 0; transition: 0.3s;">
                                    <i class="fa-solid fa-circle-check fs-2"></i>
                                </div>
                            </div>
                        </div>
                    </label>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="text-center mt-5 mb-5">
                <button type="button" class="btn btn-red btn-lg px-5 py-3 fw-bold shadow-lg rounded-pill fs-5" onclick="konfirmasiPilihan()">
                    <i class="fa-solid fa-paper-plane me-2"></i>Kirim Pilihan Saya
                </button>
            </div>
        </form>
    </div>

    <script>
        const radios = document.querySelectorAll('input[type="radio"]');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                document.querySelectorAll('.check-indicator').forEach(ind => ind.style.opacity = '0');
                if(this.checked) {
                    this.nextElementSibling.querySelector('.check-indicator').style.opacity = '1';
                }
            });
        });

        function konfirmasiPilihan() {
            let nama = document.getElementById('voter_name').value;
            if(nama.trim() === '') {
                alert('Mohon isi nama lengkap Anda terlebih dahulu!');
                document.getElementById('voter_name').focus();
                return;
            }

            let pilihan = document.querySelector('input[name="candidate_id"]:checked');
            if(!pilihan) {
                alert('Mohon pilih salah satu kandidat atau kotak kosong!');
                return;
            }

            let yakin = confirm('Apakah Anda sudah yakin dengan pilihan Anda? Data yang sudah disimpan tidak dapat diubah kembali.');

            if(yakin) {
                document.getElementById('formPemilihan').submit();
            }
        }
    </script>
</body>
</html>

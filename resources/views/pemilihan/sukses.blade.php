<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - Pemilihan RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pemilihan.css') }}">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container text-center">
        <div class="card shadow-lg border-0 rounded-4 mx-auto overflow-hidden" style="max-width: 600px;">
            <div class="card-header bg-danger text-white py-2 border-0"></div>
            <div class="card-body p-5 bg-white">
                <div class="success-icon mb-4">
                    <i class="fa-solid fa-circle-check"></i>
                </div>

                <h2 class="fw-bold mb-3 text-dark">Terima Kasih!</h2>
                <p class="lead text-muted mb-5 fs-5">
                    Suara Anda telah berhasil direkam ke dalam sistem. <br>
                    Partisipasi Anda sangat berarti bagi lingkungan RT kita.
                </p>

                <a href="{{ route('pemilihan') }}" class="btn btn-red btn-lg px-5 rounded-pill fw-bold shadow">
                    <i class="fa-solid fa-rotate-left me-2"></i>Kembali ke Halaman Awal
                </a>
            </div>
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Voting Pemilihan RT</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pemilihan.css') }}">
</head>
<body>

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-12 col-md-8 col-lg-5">
                <div class="card login-card">

                    <!-- Header Card -->
                    <div class="login-header text-center">
                        <div class="icon-container">
                            <i class="fa-solid fa-check-to-slot"></i>
                        </div>
                        <h3 class="fw-bold mb-1">E-Voting Ketua RT</h3>
                        <p class="mb-0 subtitle-text">
                            Desa Sambibulu, Dusun Sambiroto RT 17 RW 03
                        </p>
                    </div>

                    <!-- Submit Form -->
                    <div class="card-body p-4 p-md-5 bg-white">

                        <div class="text-center mb-4">
                            <h5 class="text-secondary fw-bold">Selamat Datang</h5>
                            <small class="text-muted">Silakan masukkan kredensial Anda untuk melanjutkan</small>
                        </div>

                        <!-- Error Message -->
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                                <strong><i class="fa-solid fa-triangle-exclamation me-2"></i>Gagal Login!</strong> <br>
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Login -->
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf

                            <!-- Input Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label fw-bold text-dark">Alamat Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fa-solid fa-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email" id="email" class="form-control form-control-lg border-start-0 ps-0"
                                           value="{{ old('email') }}" required autofocus placeholder="Masukkan email sistem">
                                </div>
                            </div>

                            <!-- Password Input -->
                            <div class="mb-5">
                                <label for="password" class="form-label fw-bold text-dark">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="fa-solid fa-lock text-muted"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control form-control-lg border-start-0 ps-0"
                                           required placeholder="Masukkan password">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid mt-2">
                                <button type="submit" class="btn btn-red btn-lg fw-bold py-3">
                                    Masuk ke Sistem <i class="fa-solid fa-arrow-right-to-bracket ms-2"></i>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

                <!-- Footer -->
                <div class="text-center mt-4 text-muted small pb-4">
                    &copy; 2026 Sistem Pemilihan Digital RT 17 RW 03
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

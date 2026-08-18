<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-Voting RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-check-to-slot me-2"></i>Admin E-Voting
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto ps-lg-4">
                    <li class="nav-item me-2">
                        <a class="nav-link px-3 {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-light' }}"
                           href="{{ route('admin.dashboard') }}">
                           <i class="fa-solid fa-chart-pie me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('admin.kandidat') ? 'active text-white' : 'text-light' }}"
                           href="{{ route('admin.kandidat') }}">
                           <i class="fa-solid fa-users me-1"></i> Manajemen Kandidat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('admin.users') ? 'active text-white' : 'text-light' }}"
                        href="{{ route('admin.users') }}">
                        <i class="fa-solid fa-user-shield me-1"></i> Manajemen Akun
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ request()->routeIs('admin.hasil') ? 'active text-white' : 'text-light' }}"
                        href="{{ route('admin.hasil') }}">
                        <i class="fa-solid fa-chart-pie me-1"></i> Hasil Pemilihan
                        </a>
                    </li>
                </ul>

                <form action="{{ route('logout') }}" method="POST" class="d-flex mt-3 mt-lg-0">
                    @csrf
                    <button class="btn btn-light text-danger fw-bold rounded-pill px-4 shadow-sm" type="submit">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container pb-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

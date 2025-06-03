<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inventory Management System for PT WongTux">
    <title>@yield('title', 'Inventaris PT WongTux')</title>

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --danger-color: #e74a3b;
            --warning-color: #f6c23e;
            --dark-color: #5a5c69;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
            color: #333;
            line-height: 1.6;
        }

        .navbar {
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            padding: 0.75rem 1rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, #224abe 100%);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: 0.05em;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            border-radius: 0.35rem;
        }

        .dropdown-item:active {
            background-color: var(--primary-color);
        }

        .container {
            max-width: 1200px;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            display: block;
            border-radius: 0.35rem;
        }

        .table {
            width: 100%;
            margin-bottom: 0;
            table-layout: auto;
            white-space: nowrap;
        }

        .table th {
            background-color: #f8f9fc;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: var(--secondary-color);
        }

        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1rem;
            }

            .container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .card-body {
                padding: 1rem;
            }
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
                color: black;
                font-size: 12pt;
            }

            nav, .btn, .d-print-none, .form-label, .form-control, .alert {
                display: none !important;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
                font-size: 10pt;
            }

            .table th, .table td {
                border: 1px solid #ddd !important;
                padding: 6px;
            }

            h4, h5, h6 {
                margin-top: 5mm;
                margin-bottom: 3mm;
                page-break-after: avoid;
            }

            @page {
                margin: 10mm;
                size: A4;
            }

            .no-print, .no-print * {
                display: none !important;
            }

            .print-only {
                display: block !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/dashboard">
                <i class="bi bi-box-seam me-2"></i>
                <span class="d-none d-sm-inline">Inventaris PT WongTux</span>
                <span class="d-inline d-sm-none">Inventaris</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" 
                aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-none d-md-flex flex-column text-end me-2">
                                    <span class="fw-semibold">{{ Auth::user()->name }}</span>
                                    <small class="text-white-50 text-capitalize">{{ Auth::user()->role }}</small>
                                </div>
                                <i class="bi bi-person-circle fs-5"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ganti container menjadi container-fluid -->
    <main class="container-fluid py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    @stack('scripts')

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl, {
                trigger: 'hover focus'
            });
        });

        document.querySelectorAll('.btn-print').forEach(btn => {
            btn.addEventListener('click', () => window.print());
        });
    });
    </script>
</body>
</html>

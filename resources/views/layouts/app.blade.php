<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>クラス管理システム</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <style>
        :root {
            --primary-color: #2c3e50;      /* Deep Navy - Professional and academic */
            --secondary-color: #34495e;    /* Dark Slate - For contrast */
            --success-color: #27ae60;      /* Green - For success messages */
            --warning-color: #f39c12;      /* Orange - For warnings */
            --danger-color: #c0392b;       /* Red - For danger messages */
            --info-color: #3498db;         /* Blue - For information */
            --light-color: #ecf0f1;        /* Light Gray - For backgrounds */
            --dark-color: #2c3e50;         /* Dark Navy - For text */
            --text-color: #2c3e50;         /* Dark Navy - For text */
            --background-color: #f8f9fa;   /* Very Light Gray - For cards */
            --hover-color: #34495e;        /* Dark Slate - For hover effects */
            --success-bg: #d4edda;         /* Light Green - For success backgrounds */
            --warning-bg: #fff3cd;         /* Light Yellow - For warning backgrounds */
            --danger-bg: #f8d7da;          /* Light Red - For danger backgrounds */
            --info-bg: #d1ecf1;            /* Light Blue - For info backgrounds */
            --border-color: #e0e0e0;       /* Light Gray - For borders */
            --shadow-color: rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .navbar {
            background-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px var(--shadow-color);
            padding: 1rem 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.25rem;
            padding: 0.5rem 1rem;
        }

        .navbar-brand i {
            font-size: 1.5rem;
            color: var(--success-color);
        }

        .nav-link {
            color: white !important;
            padding: 0.75rem 1.5rem !important;
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background-color: var(--hover-color) !important;
            color: white !important;
            border-color: var(--success-color);
        }

        .nav-link i {
            font-size: 1.25rem;
            width: 2rem;
            text-align: center;
            color: var(--success-color);
        }

        .nav-link span {
            font-weight: 500;
        }

        .active .nav-link, .nav-link.active {
            background-color: var(--hover-color) !important;
            border-color: var(--success-color);
        }

        .navbar-toggler {
            border: none;
            padding: 0.5rem;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-collapse {
            flex-grow: 0;
        }

        @media (max-width: 991.98px) {
            .navbar-nav {
                background: rgba(255, 255, 255, 0.1);
                padding: 0.5rem;
                border-radius: 0.5rem;
                margin-top: 1rem;
            }

            .nav-link {
                width: 100%;
                text-align: left;
                padding: 0.75rem 1rem !important;
            }

            .nav-link i {
                width: auto;
                margin-right: 0.75rem;
            }
        }

        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .btn-primary:hover {
            background-color: var(--hover-color) !important;
            border-color: var(--hover-color) !important;
            color: white !important;
        }

        .card-header.bg-primary {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .table-hover tbody tr:hover {
            background-color: var(--light-color) !important;
        }

        .table th {
            background-color: var(--light-color) !important;
            color: var(--dark-color) !important;
        }

        .btn-info {
            background-color: var(--info-color) !important;
            border-color: var(--info-color) !important;
            color: white !important;
        }

        .btn-info:hover {
            background-color: #2980b9 !important;
            border-color: #2980b9 !important;
            color: white !important;
        }

        .btn-warning {
            background-color: var(--warning-color) !important;
            border-color: var(--warning-color) !important;
            color: white !important;
        }

        .btn-warning:hover {
            background-color: #e67e22 !important;
            border-color: #e67e22 !important;
            color: white !important;
        }

        .btn-danger {
            background-color: var(--danger-color) !important;
            border-color: var(--danger-color) !important;
            color: white !important;
        }

        .btn-danger:hover {
            background-color: #c0392b !important;
            border-color: #c0392b !important;
            color: white !important;
        }

        .btn-light {
            background-color: white !important;
            border-color: var(--border-color) !important;
            color: var(--dark-color) !important;
        }

        .btn-light:hover {
            background-color: var(--light-color) !important;
            color: var(--dark-color) !important;
        }

        .pagination .page-link {
            color: var(--dark-color) !important;
            border-color: var(--border-color) !important;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem var(--shadow-color) !important;
        }

        .invalid-feedback {
            color: var(--danger-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-success {
            color: var(--success-color) !important;
        }

        .text-warning {
            color: var(--warning-color) !important;
        }

        .text-danger {
            color: var(--danger-color) !important;
        }

        .text-info {
            color: var(--info-color) !important;
        }

        .bg-light {
            background-color: var(--light-color) !important;
        }

        .bg-dark {
            background-color: var(--dark-color) !important;
        }

        .text-muted {
            color: #7f8c8d !important;
        }

        .badge {
            background-color: var(--primary-color) !important;
            color: white !important;
        }

        .badge-success {
            background-color: var(--success-color) !important;
            color: white !important;
        }

        .badge-warning {
            background-color: var(--warning-color) !important;
            color: white !important;
        }

        .badge-danger {
            background-color: var(--danger-color) !important;
            color: white !important;
        }

        .badge-info {
            background-color: var(--info-color) !important;
            color: white !important;
        }

        .alert-success {
            background-color: var(--success-bg) !important;
            border-color: var(--success-color) !important;
            color: var(--dark-color) !important;
        }

        .alert-danger {
            background-color: var(--danger-bg) !important;
            border-color: var(--danger-color) !important;
            color: var(--dark-color) !important;
        }

        .alert-info {
            background-color: var(--info-bg) !important;
            border-color: var(--info-color) !important;
            color: var(--dark-color) !important;
        }

        .alert-warning {
            background-color: var(--warning-bg) !important;
            border-color: var(--warning-color) !important;
            color: var(--dark-color) !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <i class="fas fa-graduation-cap me-2"></i>
                <span>クラス管理システム</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('students.index') }}">
                            <i class="fas fa-user-graduate me-2"></i>
                            <span>生徒一覧</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('teachers.index') }}">
                            <i class="fas fa-chalkboard-teacher me-2"></i>
                            <span>教師一覧</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('courses.index') }}">
                            <i class="fas fa-book me-2"></i>
                            <span>コース一覧</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('subjects.index') }}">
                            <i class="fas fa-scroll me-2"></i>
                            <span>科目一覧</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('departments.index') }}">
                            <i class="fas fa-building me-2"></i>
                            <span>部署一覧</span>
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-2"></i>
                                <span>ログイン</span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                <span>ログアウト</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

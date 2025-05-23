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
<body style="display: flex;">
    <div class="d-flex flex-column flex-shrink-0 bg-white border-end" style="width: 304px; height: 100vh; overflow-y: auto; position: fixed;">
        <div class="sidebar-header">
            <div class="d-flex align-items-center p-4">
                <i class="fas fa-graduation-cap text-primary me-3"></i>
                <span class="sidebar-title">クラス管理システム</span>
            </div>
            <div class="sidebar-search px-4 mb-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="検索...">
                </div>
            </div>
        </div>

        <div class="sidebar-content">
            <div class="nav flex-column nav-pills mb-auto">
                <a href="{{ route('classes.index') }}" class="nav-link">
                    <i class="fas fa-book-reader text-primary me-3"></i>
                    <span>クラス一覧</span>
                </a>
                <a href="{{ route('students.index') }}" class="nav-link">
                    <i class="fas fa-user-graduate text-primary me-3"></i>
                    <span>生徒一覧</span>
                </a>
                <a href="{{ route('teachers.index') }}" class="nav-link">
                    <i class="fas fa-chalkboard-teacher text-primary me-3"></i>
                    <span>教師一覧</span>
                </a>
                <a href="{{ route('courses.index') }}" class="nav-link">
                    <i class="fas fa-book text-primary me-3"></i>
                    <span>コース一覧</span>
                </a>
                <a href="{{ route('subjects.index') }}" class="nav-link">
                    <i class="fas fa-scroll text-primary me-3"></i>
                    <span>科目一覧</span>
                </a>
                <a href="{{ route('departments.index') }}" class="nav-link">
                    <i class="fas fa-building text-primary me-3"></i>
                    <span>部署一覧</span>
                </a>
                <a href="{{ route('classSubjectTeachers.index') }}" class="nav-link">
                    <i class="fas fa-book text-primary me-3"></i>
                    <span>クラス-科目-教師一覧</span>
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="d-flex align-items-center px-4 py-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary d-flex align-items-center w-100">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        ログイン
                    </a>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger d-flex align-items-center w-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        ログアウト
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endguest
            </div>
        </div>
    </div>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="main-content">
                        <!-- Page Title -->
                        @if(View::hasSection('title'))
                            <h1 class="mb-4 page-title">
                                @yield('title')
                            </h1>
                        @endif

                        <!-- Success Messages -->
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Error Messages -->
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Form Validation Errors -->
                        {{-- @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif --}}

                        <!-- Main Content -->
                        <div class="content-wrapper" style="min-height: calc(100vh - 150px);">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Layout Styles */
        .d-flex.flex-column.flex-shrink-0 {
            min-height: 100vh;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            background-color: var(--background-color);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
        }

        .sidebar-search .input-group {
            border-radius: 20px;
            background-color: var(--light-color);
            border: 1px solid var(--border-color);
        }

        .sidebar-search .input-group-text {
            background-color: transparent;
            border: none;
            color: var(--text-color);
            padding: 0.5rem 1rem;
        }

        .sidebar-search .form-control {
            border: none;
            background-color: transparent;
            padding: 0.5rem 1rem;
            color: var(--text-color);
        }

        .sidebar-search .form-control:focus {
            box-shadow: none;
            border-color: var(--primary-color);
        }

        .sidebar-content {
            flex: 1;
            padding: 1.5rem;
            overflow-y: auto;
        }

        .sidebar-footer {
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
            background-color: var(--background-color);
        }

        .sidebar-footer .btn {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            width: 100%;
        }

        .sidebar-footer .btn:hover {
            transform: translateY(-2px);
        }


        .content-wrapper {
            min-height: calc(100vh - 150px);
            padding: 2rem;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 2rem;
        }

        .alert {
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-dismissible .btn-close {
            padding: 0.5rem;
            opacity: 0.5;
        }

        .alert-dismissible .btn-close:hover {
            opacity: 1;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: var(--background-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
        }

        .card-body {
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--light-color);
            border-bottom: 2px solid var(--border-color);
        }

        .table td {
            vertical-align: middle;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 2rem;
        }

        .alert {
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-dismissible .btn-close {
            padding: 0.5rem;
            opacity: 0.5;
        }

        .alert-dismissible .btn-close:hover {
            opacity: 1;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: var(--background-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
        }

        .card-body {
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--light-color);
            border-bottom: 2px solid var(--border-color);
        }

        .table td {
            vertical-align: middle;
        }

        .btn {
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
        }

        .nav-link {
            color: var(--text-color) !important;
            padding: 0.75rem 1rem !important;
            transition: all 0.2s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-radius: 8px;
            margin: 0.25rem 0;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: var(--light-color);
            transform: translateX(5px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .nav-link i {
            font-size: 1.2rem;
            width: 1.5rem;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .nav-link:hover i {
            transform: scale(1.1);
        }

        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: var(--light-color);
            border-left: 3px solid var(--primary-color);
            margin-left: 0.25rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .nav-link.active i {
            color: var(--primary-color) !important;
            transform: scale(1.1);
        }

        .sidebar-footer {
            border-top: 1px solid var(--border-color);
            padding: 1.5rem;
            background-color: var(--background-color);
        }

        .sidebar-footer .btn {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .sidebar-footer .btn:hover {
            transform: translateY(-2px);
        }

        .border-end {
            border-right: 1px solid var(--border-color);
        }

        .fs-4 {
            font-size: 1.25rem;
        }

        .fw-bold {
            font-weight: 600;
        }

        .container-fluid {
            padding: 0;
        }

        .container-fluid > .row {
            margin-right: 0;
            margin-left: 0;
        }

        .main-content {
            padding: 2rem 2rem;
            min-height: calc(100vh - 100px);
        }

        .main-content > .container-fluid {
            max-width: 100%;
            padding: 0 1rem;
        }

        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-header {
            background-color: var(--background-color);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
        }

        .card-body {
            padding: 1.5rem;
        }
    </style>
</body>
</html>

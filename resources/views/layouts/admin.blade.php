<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Horizon System') - Admin Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f8f9fc;
        }
        
        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transition: all 0.3s;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            margin: 4px 0;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
            border-right: 3px solid #ffd700;
        }
        
        .sidebar .nav-link i {
            margin-right: 12px;
            width: 20px;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-bottom: 1px solid #e0e0e0;
        }
        
        /* Cards */
        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: all 0.3s;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }
        
        /* Tables */
        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .data-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .data-table th {
            border: none;
            padding: 15px;
            font-weight: 600;
        }
        
        .data-table td {
            padding: 12px 15px;
            vertical-align: middle;
        }
        
        /* Buttons */
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
            color: white;
        }
        
        /* Alerts */
        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-height: auto;
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                z-index: 1000;
                transition: left 0.3s;
            }
            
            .sidebar.show {
                left: 0;
            }
            
            .main-content {
                width: 100%;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    
    @stack('styles')
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-3">
            <div class="text-center mb-4">
                <i class="fas fa-graduation-cap fa-3x mb-2"></i>
                <h4 class="fw-bold">Horizon System</h4>
                <p class="small opacity-75">Admin Dashboard</p>
            </div>
            
            <nav class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i> Students
                </a>
                <a href="{{ route('guardians.index') }}" class="nav-link {{ request()->routeIs('guardians.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Guardians
                </a>
                <a href="{{ route('schools.index') }}" class="nav-link {{ request()->routeIs('schools.*') ? 'active' : '' }}">
                    <i class="fas fa-school"></i> Schools
                </a>
                <a href="{{ route('levels.index') }}" class="nav-link {{ request()->routeIs('levels.*') ? 'active' : '' }}">
                    <i class="fas fa-layer-group"></i> Levels
                </a>
                <a href="{{ route('camps.index') }}" class="nav-link {{ request()->routeIs('camps.*') ? 'active' : '' }}">
                    <i class="fas fa-campground"></i> Camps
                </a>
                <hr class="my-3" style="border-color: rgba(255,255,255,0.2);">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 main-content">
            <!-- Top Bar -->
            <div class="top-bar d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-link d-md-none" id="sidebarToggle">
                        <i class="fas fa-bars fa-lg"></i>
                    </button>
                    <h5 class="mb-0 fw-bold">@yield('page-title', 'Dashboard')</h5>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <button class="btn btn-link text-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <span class="ms-2 d-none d-sm-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Content Area -->
            <div class="p-4 fade-in">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show alert-custom" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sidebar toggle for mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('show');
    });
    
    // Confirm delete with SweetAlert
    window.confirmDelete = function(formId, itemName) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete ${itemName}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
        return false;
    };
</script>

@stack('scripts')
</body>
</html>
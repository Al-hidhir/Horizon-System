{{-- @extends('layouts.app')

@section('content')

<h2>Camp Students Dashboard</h2>

<!-- STAT CARD -->
<div class="card p-3 mb-4">
    <h4>Total Camp Students: {{ $totalCampStudents }}</h4>
</div>

<!-- GROUP BY LEVEL -->
@foreach($byLevel as $level => $students)
    <div class="card p-3 mb-4">
        <h5>{{ $level }} ({{ $students->count() }})</h5>

        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $enrollment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $enrollment->student->full_name }}</td>
                        <td>{{ $enrollment->student->gender }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach

@endsection --}}

@extends('layouts.app')

@section('content')
<div class="camp-dashboard-container">
    <!-- Header Section -->
    <div class="dashboard-header">
        <div class="header-icon">
            <i class="fas fa-campground"></i>
        </div>
        <div class="header-text">
            <h1 class="dashboard-title">Camp Students Dashboard</h1>
            <p class="dashboard-subtitle">Monitor and manage all students enrolled in camp programs</p>
        </div>
        <div class="header-actions">
            <button class="btn-refresh" onclick="window.location.reload()">
                <i class="fas fa-sync-alt"></i>
                <span>Refresh</span>
            </button>
        </div>
    </div>

    <!-- Stats Overview Cards -->
    <div class="stats-overview">
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-details">
                <span class="stat-label">Total Camp Students</span>
                <h2 class="stat-number">{{ $totalCampStudents }}</h2>
                <span class="stat-trend">
                    <i class="fas fa-user-plus"></i> Active enrollments
                </span>
            </div>
        </div>
        
        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <i class="fas fa-layer-group"></i>
            </div>
            <div class="stat-details">
                <span class="stat-label">Academic Levels</span>
                <h2 class="stat-number">{{ $byLevel->count() }}</h2>
                <span class="stat-trend">
                    <i class="fas fa-chart-line"></i> Active levels
                </span>
            </div>
        </div>
        
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <div class="stat-details">
                <span class="stat-label">Enrollment Rate</span>
                <h2 class="stat-number">
                    {{ $totalCampStudents > 0 ? round(($totalCampStudents / max($totalCampStudents, 1)) * 100, 0) : 0 }}%
                </h2>
                <span class="stat-trend">
                    <i class="fas fa-percent"></i> Capacity utilization
                </span>
            </div>
        </div>
    </div>

    <!-- Level Groups -->
    <div class="levels-container">
        @forelse($byLevel as $level => $students)
            <div class="level-card">
                <div class="level-header">
                    <div class="level-title-section">
                        <i class="fas fa-graduation-cap"></i>
                        <h3 class="level-name">{{ $level }}</h3>
                        <span class="student-count-badge">{{ $students->count() }} Students</span>
                    </div>
                    <div class="level-actions">
                        <button class="btn-expand" onclick="toggleTable(this)">
                            <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
                
                <div class="level-table-wrapper">
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-user"></i> Student Name</th>
                                <th><i class="fas fa-venus-mars"></i> Gender</th>
                                <th><i class="fas fa-id-card"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $enrollment)
                                <tr>
                                    <td data-label="#">{{ $loop->iteration }}</td>
                                    <td data-label="Student Name">
                                        <div class="student-info">
                                            <div class="student-avatar">
                                                @php
                                                    $initial = strtoupper(substr($enrollment->student->full_name, 0, 1));
                                                @endphp
                                                <span class="avatar-initial">{{ $initial }}</span>
                                            </div>
                                            <span class="student-name">{{ $enrollment->student->full_name }}</span>
                                        </div>
                                    </td>
                                    <td data-label="Gender">
                                        @if($enrollment->student->gender == 'Male')
                                            <span class="gender-badge gender-male">
                                                <i class="fas fa-mars"></i> Male
                                            </span>
                                        @elseif($enrollment->student->gender == 'Female')
                                            <span class="gender-badge gender-female">
                                                <i class="fas fa-venus"></i> Female
                                            </span>
                                        @else
                                            <span class="gender-badge gender-other">
                                                <i class="fas fa-genderless"></i> {{ $enrollment->student->gender }}
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Status">
                                        <span class="status-badge status-active">
                                            <i class="fas fa-check-circle"></i> Enrolled
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-campground"></i>
                <h3>No Camp Students Found</h3>
                <p>There are currently no students enrolled in camp programs.</p>
                <a href="/enrollments/create" class="btn-empty-action">
                    <i class="fas fa-plus"></i> Enroll a Student
                </a>
            </div>
        @endforelse
    </div>

    <!-- Export Section -->
    @if($totalCampStudents > 0)
        <div class="export-section">
            <div class="export-card">
                <i class="fas fa-download"></i>
                <div class="export-text">
                    <strong>Export Data</strong>
                    <span>Download camp enrollment reports</span>
                </div>
                <button class="btn-export" onclick="exportToCSV()">
                    <i class="fas fa-file-csv"></i> Export CSV
                </button>
            </div>
        </div>
    @endif
</div>

<style>
    /* Container */
    .camp-dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        animation: fadeInUp 0.4s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header */
    .dashboard-header {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #eef2ff;
        flex-wrap: wrap;
    }

    .header-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-icon i {
        font-size: 1.8rem;
        color: #4f46e5;
    }

    .header-text {
        flex: 1;
    }

    .dashboard-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e293b, #4f46e5);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .dashboard-subtitle {
        color: #64748b;
        margin: 0.25rem 0 0;
        font-size: 0.9rem;
    }

    .header-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn-refresh {
        background: white;
        border: 2px solid #e2e8f0;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        font-weight: 500;
        font-size: 0.85rem;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-refresh:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-1px);
    }

    /* Stats Overview */
    .stats-overview {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.6rem;
    }

    .stat-card-primary .stat-icon {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: #4f46e5;
    }

    .stat-card-info .stat-icon {
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        color: #0284c7;
    }

    .stat-card-success .stat-icon {
        background: linear-gradient(135deg, #dcfce7, #bbf7d0);
        color: #16a34a;
    }

    .stat-details {
        flex: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #64748b;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0.25rem 0 0.5rem;
        color: #0f172a;
        line-height: 1.2;
    }

    .stat-trend {
        font-size: 0.7rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Levels Container */
    .levels-container {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .level-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        transition: all 0.2s;
    }

    .level-card:hover {
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    }

    .level-header {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
        cursor: pointer;
    }

    .level-title-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .level-title-section i {
        font-size: 1.5rem;
        color: #4f46e5;
    }

    .level-name {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .student-count-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 0.25rem 0.75rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-expand {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 10px;
        transition: all 0.2s;
        color: #64748b;
    }

    .btn-expand:hover {
        background: #e2e8f0;
    }

    .btn-expand i {
        transition: transform 0.2s;
    }

    .level-card.collapsed .btn-expand i {
        transform: rotate(-90deg);
    }

    .level-card.collapsed .level-table-wrapper {
        display: none;
    }

    /* Student Table */
    .level-table-wrapper {
        overflow-x: auto;
        padding: 1.5rem;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table thead th {
        text-align: left;
        padding: 1rem 0.75rem;
        background: #f8fafc;
        font-weight: 600;
        color: #475569;
        font-size: 0.85rem;
        border-bottom: 2px solid #e2e8f0;
    }

    .student-table tbody td {
        padding: 1rem 0.75rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.9rem;
    }

    .student-table tbody tr:hover {
        background: #f8fafc;
    }

    .student-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .student-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #4f46e5, #818cf8);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-initial {
        color: white;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .student-name {
        font-weight: 500;
        color: #1e293b;
    }

    /* Gender Badges */
    .gender-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 0.8rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .gender-male {
        background: #dbeafe;
        color: #1e40af;
    }

    .gender-female {
        background: #fce7f3;
        color: #be185d;
    }

    .gender-other {
        background: #f1f5f9;
        color: #475569;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 0.8rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 28px;
        border: 1px solid #f0f2f5;
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1.3rem;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 1.5rem;
    }

    .btn-empty-action {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        padding: 0.7rem 1.5rem;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-empty-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    /* Export Section */
    .export-section {
        margin-top: 1rem;
    }

    .export-card {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 20px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        border: 1px solid #e2e8f0;
    }

    .export-card i {
        font-size: 1.5rem;
        color: #4f46e5;
    }

    .export-text {
        flex: 1;
    }

    .export-text strong {
        display: block;
        color: #1e293b;
    }

    .export-text span {
        font-size: 0.75rem;
        color: #64748b;
    }

    .btn-export {
        background: white;
        border: 2px solid #e2e8f0;
        padding: 0.6rem 1.2rem;
        border-radius: 40px;
        font-weight: 500;
        font-size: 0.85rem;
        color: #4f46e5;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-export:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-overview {
            grid-template-columns: 1fr;
        }
        
        .student-table thead {
            display: none;
        }
        
        .student-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1rem;
        }
        
        .student-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border: none;
        }
        
        .student-table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #475569;
        }
        
        .level-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }
        
        .level-title-section {
            flex-wrap: wrap;
        }
        
        .export-card {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<script>
    function toggleTable(button) {
        const levelCard = button.closest('.level-card');
        if (levelCard) {
            levelCard.classList.toggle('collapsed');
        }
    }

    function exportToCSV() {
        const tables = document.querySelectorAll('.student-table');
        let csvContent = "Level,Student Name,Gender,Status\n";
        
        tables.forEach(table => {
            const levelName = table.closest('.level-card').querySelector('.level-name')?.innerText || 'Unknown';
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const studentName = row.querySelector('.student-name')?.innerText || '';
                const gender = row.querySelector('.gender-badge')?.innerText.trim() || '';
                const status = row.querySelector('.status-badge')?.innerText.trim() || '';
                
                csvContent += `"${levelName}","${studentName}","${gender}","${status}"\n`;
            });
        });
        
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.href = url;
        link.setAttribute('download', 'camp_students_report.csv');
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
</script>
@endsection
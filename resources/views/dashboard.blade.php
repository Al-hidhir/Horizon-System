@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Students</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalStudents ?? 0 }}</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +12% from last month
                    </small>
                </div>
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Guardians</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalGuardians ?? 0 }}</h3>
                    <small class="text-success">
                        <i class="fas fa-arrow-up"></i> +8% from last month
                    </small>
                </div>
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Schools</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalSchools ?? 0 }}</h3>
                    <small class="text-info">
                        <i class="fas fa-building"></i> Active institutions
                    </small>
                </div>
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-school"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Active Camps</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalCamps ?? 0 }}</h3>
                    <small class="text-warning">
                        <i class="fas fa-calendar"></i> Ongoing programs
                    </small>
                </div>
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-campground"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mt-4">
    <div class="col-md-8">
        <div class="stat-card">
            <h6 class="mb-3 fw-bold">Student Enrollment Trend</h6>
            <canvas id="enrollmentChart" height="300"></canvas>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="stat-card">
            <h6 class="mb-3 fw-bold">Students by Level</h6>
            <canvas id="levelChart" height="300"></canvas>
        </div>
    </div>
</div>

<!-- Recent Students Table -->
<div class="row mt-4">
    <div class="col-12">
        <div class="data-table">
            <div class="p-3 bg-white border-bottom">
                <h6 class="mb-0 fw-bold">Recent Students</h6>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>School</th>
                            <th>Level</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentStudents ?? [] as $student)
                        <tr>
                            <td class="fw-bold">{{ $student->full_name }}</td>
                            <td><span class="badge bg-{{ $student->gender == 'Male' ? 'info' : 'danger' }}">{{ $student->gender }}</span></td>
                            <td>{{ $student->school->name ?? 'N/A' }}</td>
                            <td>{{ $student->level->name ?? 'N/A' }}</td>
                            <td>{{ $student->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2 d-block"></i>
                                No students found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enrollment Trend Chart
    const ctx = document.getElementById('enrollmentChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Students',
                data: [12, 19, 15, 17, 14, 20, 25, 22, 18, 23, 28, 30],
                borderColor: '#667eea',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
    
    // Level Distribution Chart
    const levelCtx = document.getElementById('levelChart').getContext('2d');
    new Chart(levelCtx, {
        type: 'doughnut',
        data: {
            labels: ['Form 1', 'Form 2', 'Form 3', 'Form 4'],
            datasets: [{
                data: [30, 35, 25, 20],
                backgroundColor: ['#667eea', '#764ba2', '#f59e0b', '#10b981'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
</script>
@endpush
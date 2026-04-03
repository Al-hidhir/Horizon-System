{{-- @extends('layouts.app')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<!-- STAT CARDS -->
<div class="row">

    <div class="col-md-4">
        <div class="card bg-primary text-white p-3">
            <h5>Total Students</h5>
            <h2>{{ $totalStudents }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h5>Total Schools</h5>
            <h2>{{ $totalSchools }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-dark text-white p-3">
            <h5>Total Guardians</h5>
            <h2>{{ $totalGuardians }}</h2>
        </div>
    </div>

</div>

<br>

<!-- QUICK ACTIONS -->
<div class="card p-3 mb-4">
    <h5>Quick Actions</h5>

    <a href="/students/create" class="btn btn-primary">Add Student</a>
    <a href="/schools/create" class="btn btn-success">Add School</a>
    <a href="/levels/create" class="btn btn-warning">Add Level</a>
    <a href="/guardians/create" class="btn btn-dark">Add Guardian</a>
</div>

<!-- LEVEL STATS -->
<div class="card p-3">
    <h5>Students by Level</h5>

    <p>Form 2: {{ $form2 }}</p>
    <p>Form 4: {{ $form4 }}</p>
    <p>Form 6: {{ $form6 }}</p>

</div>

<canvas id="levelChart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('levelChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Form 2', 'Form 4', 'Form 6'],
        datasets: [{
            label: 'Students',
            data: [{{ $form2 }}, {{ $form4 }}, {{ $form6 }}],
            borderWidth: 1
        }]
    }
});
</script>

@endsection --}}

{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    {{-- <!-- Page Header -->
    <div class="dashboard-header mb-4">
        <div>
            <h3 class="dashboard-title">Dashboard</h3>
            <p class="dashboard-subtitle">Welcome back! Here's what's happening with your institution today.</p>
        </div>
        <div class="dashboard-date">
            <i class="fas fa-calendar-alt me-2"></i>
            <span id="currentDate"></span>
        </div>
    </div> --}}

    <!-- STAT CARDS - Premium Redesign -->
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-card-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="stat-card-content">
                    <span class="stat-label">Total Students</span>
                    <h2 class="stat-value">{{ $totalStudents }}</h2>
                    <div class="stat-trend">
                        <i class="fas fa-arrow-up"></i> <span>Horizon Institute of Technology</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card stat-card-success">
                <div class="stat-card-icon">
                    <i class="fas fa-building-columns"></i>
                </div>
                <div class="stat-card-content">
                    <span class="stat-label">Total Schools</span>
                    <h2 class="stat-value">{{ $totalSchools }}</h2>
                    <div class="stat-trend">
                        <i class="fas fa-plus-circle"></i> <span>Active campuses</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card stat-card-dark">
                <div class="stat-card-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="stat-card-content">
                    <span class="stat-label">Total Guardians</span>
                    <h2 class="stat-value">{{ $totalGuardians }}</h2>
                    <div class="stat-trend">
                        <i class="fas fa-users"></i> <span>Connected families</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Two Column Layout for Quick Actions + Level Stats -->
    <div class="row g-4 mb-5">
        <!-- QUICK ACTIONS - Modern Button Grid -->
        <div class="col-lg-5">
            <div class="action-card">
                <div class="action-card-header">
                    <i class="fas fa-bolt"></i>
                    <h5>Quick Actions</h5>
                </div>
                <div class="action-buttons">
                    <a href="/students/create" class="action-btn action-btn-primary">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Student</span>
                    </a>
                    <a href="/schools/create" class="action-btn action-btn-success">
                        <i class="fas fa-school"></i>
                        <span>Add School</span>
                    </a>
                    <a href="/levels/create" class="action-btn action-btn-warning">
                        <i class="fas fa-layer-group"></i>
                        <span>Add Level</span>
                    </a>
                    <a href="/guardians/create" class="action-btn action-btn-dark">
                        <i class="fas fa-user-check"></i>
                        <span>Add Guardian</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- LEVEL STATS - Modern Summary Card -->
        <div class="col-lg-7">
            <div class="stats-summary-card">
                <div class="stats-summary-header">
                    <i class="fas fa-chart-pie"></i>
                    <h5>Students by Academic Level</h5>
                </div>
                <div class="level-stats-grid">
                    <div class="level-stat-item">
                        <div class="level-stat-label">Form 2</div>
                        <div class="level-stat-value">{{ $form2 }}</div>
                        <div class="level-stat-bar">
                            <div class="level-stat-progress" style="width: {{ $totalStudents > 0 ? ($form2 / $totalStudents) * 100 : 0 }}%"></div>
                        </div>
                        <div class="level-stat-percentage">{{ $totalStudents > 0 ? round(($form2 / $totalStudents) * 100, 1) : 0 }}%</div>
                    </div>
                    <div class="level-stat-item">
                        <div class="level-stat-label">Form 4</div>
                        <div class="level-stat-value">{{ $form4 }}</div>
                        <div class="level-stat-bar">
                            <div class="level-stat-progress" style="width: {{ $totalStudents > 0 ? ($form4 / $totalStudents) * 100 : 0 }}%"></div>
                        </div>
                        <div class="level-stat-percentage">{{ $totalStudents > 0 ? round(($form4 / $totalStudents) * 100, 1) : 0 }}%</div>
                    </div>
                    <div class="level-stat-item">
                        <div class="level-stat-label">Form 6</div>
                        <div class="level-stat-value">{{ $form6 }}</div>
                        <div class="level-stat-bar">
                            <div class="level-stat-progress" style="width: {{ $totalStudents > 0 ? ($form6 / $totalStudents) * 100 : 0 }}%"></div>
                        </div>
                        <div class="level-stat-percentage">{{ $totalStudents > 0 ? round(($form6 / $totalStudents) * 100, 1) : 0 }}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHART SECTION - Enhanced Visualization -->
    <div class="chart-card">
        <div class="chart-card-header">
            <div>
                <i class="fas fa-chart-bar"></i>
                <h5>Student Distribution by Level</h5>
                <p class="chart-subtitle">Visual representation of enrollment across academic levels</p>
            </div>
            <div class="chart-legend">
                <span class="legend-dot" style="background: #4f46e5;"></span> Current Enrollment
            </div>
        </div>
        <div class="chart-container">
            <canvas id="levelChart"></canvas>
        </div>
    </div>
</div>

<!-- Styles -->
<style>
    /* Dashboard Wrapper */
    .dashboard-wrapper {
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

    /* Header Styles */
    .dashboard-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #eef2ff;
    }

    .dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e293b, #3b82f6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin-bottom: 0.25rem;
    }

    .dashboard-subtitle {
        color: #64748b;
        font-size: 0.875rem;
        margin: 0;
    }

    .dashboard-date {
        background: #f8fafc;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        border: 1px solid #e2e8f0;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.25rem;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 2px rgba(0,0,0,0.03);
        border: 1px solid #f0f2f5;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 30px -12px rgba(0,0,0,0.1);
    }

    .stat-card-primary {
        border-left: 4px solid #4f46e5;
    }
    .stat-card-success {
        border-left: 4px solid #10b981;
    }
    .stat-card-dark {
        border-left: 4px solid #1e293b;
    }

    .stat-card-icon {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
    }

    .stat-card-primary .stat-card-icon {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        color: #4f46e5;
    }
    .stat-card-success .stat-card-icon {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: #10b981;
    }
    .stat-card-dark .stat-card-icon {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        color: #1e293b;
    }

    .stat-card-content {
        flex: 1;
    }

    .stat-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        color: #64748b;
    }

    .stat-value {
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

    .stat-trend i {
        font-size: 0.65rem;
    }

    /* Action Card */
    .action-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        height: 100%;
    }

    .action-card-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .action-card-header i {
        font-size: 1.4rem;
        color: #f59e0b;
        background: #fffbeb;
        padding: 0.5rem;
        border-radius: 14px;
    }

    .action-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1e293b;
    }

    .action-buttons {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        border: none;
    }

    .action-btn i {
        font-size: 1rem;
    }

    .action-btn-primary {
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.2);
    }
    .action-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    .action-btn-success {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.2);
    }
    .action-btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .action-btn-warning {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2);
    }
    .action-btn-warning:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        color: white;
    }

    .action-btn-dark {
        background: linear-gradient(135deg, #1e293b, #334155);
        color: white;
        box-shadow: 0 2px 6px rgba(30, 41, 59, 0.2);
    }
    .action-btn-dark:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 41, 59, 0.3);
        color: white;
    }

    /* Stats Summary Card */
    .stats-summary-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        height: 100%;
    }

    .stats-summary-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .stats-summary-header i {
        font-size: 1.4rem;
        color: #3b82f6;
        background: #eff6ff;
        padding: 0.5rem;
        border-radius: 14px;
    }

    .stats-summary-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1e293b;
    }

    .level-stats-grid {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .level-stat-item {
        width: 100%;
    }

    .level-stat-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .level-stat-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .level-stat-bar {
        background: #e2e8f0;
        border-radius: 30px;
        height: 8px;
        overflow: hidden;
        margin: 0.5rem 0;
    }

    .level-stat-progress {
 background: linear-gradient(90deg, #4f46e5, #818cf8);
        height: 100%;
        border-radius: 30px;
        transition: width 0.6s ease;
    }

    .level-stat-percentage {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
        margin-top: 0.25rem;
    }

    /* Chart Card */
    .chart-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #f0f2f5;
        margin-top: 1rem;
    }

    .chart-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f5f9;
    }

    .chart-card-header > div {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .chart-card-header i {
        font-size: 1.4rem;
        color: #4f46e5;
        background: #eef2ff;
        padding: 0.5rem;
        border-radius: 14px;
    }

    .chart-card-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1e293b;
    }

    .chart-subtitle {
        font-size: 0.75rem;
        color: #94a3b8;
        margin: 0;
        width: 100%;
        margin-left: 3rem;
    }

    .chart-legend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #475569;
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
    }

    .chart-container {
        position: relative;
        height: 320px;
        width: 100%;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .action-buttons {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            flex-direction: column;
            text-align: center;
        }
        
        .stat-card-icon {
            margin-bottom: 0.5rem;
        }
        
        .chart-container {
            height: 250px;
        }
        
        .chart-card-header {
            flex-direction: column;
            gap: 1rem;
        }
        
        .chart-subtitle {
            margin-left: 0;
        }
    }
</style>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Set current date
    const dateElem = document.getElementById('currentDate');
    if (dateElem) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        dateElem.innerText = new Date().toLocaleDateString(undefined, options);
    }

    // Initialize Chart with enhanced styling
    const ctx = document.getElementById('levelChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Form 2', 'Form 4', 'Form 6'],
            datasets: [{
                label: 'Number of Students',
                data: [{{ $form2 }}, {{ $form4 }}, {{ $form6 }}],
                backgroundColor: [
                    'rgba(79, 70, 229, 0.85)',
                    'rgba(16, 185, 129, 0.85)',
                    'rgba(245, 158, 11, 0.85)'
                ],
                borderColor: [
                    '#4f46e5',
                    '#10b981',
                    '#f59e0b'
                ],
                borderWidth: 2,
                borderRadius: 12,
                barPercentage: 0.65,
                categoryPercentage: 0.8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    backgroundColor: '#1e293b',
                    titleColor: '#f1f5f9',
                    bodyColor: '#cbd5e1',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return `Students: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#e2e8f0',
                        drawBorder: false,
                    },
                    title: {
                        display: true,
                        text: 'Number of Students',
                        color: '#64748b',
                        font: {
                            weight: '500',
                            size: 12
                        }
                    },
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        color: '#475569'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Academic Level',
                        color: '#64748b',
                        font: {
                            weight: '500',
                            size: 12
                        }
                    },
                    ticks: {
                        color: '#475569',
                        font: {
                            weight: '500'
                        }
                    }
                }
            },
            animation: {
                duration: 800,
                easing: 'easeOutQuart'
            }
        }
    });
</script>

@endsection
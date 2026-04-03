{{-- <!DOCTYPE html>
<html>
<head>
    <title>Horizon Institute System</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f5f6fa;
        }

        .sidebar{
            height:100vh;
            background:#2f3640;
            color:white;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:10px;
        }

        .sidebar a:hover{
            background:#353b48;
        }

        .topbar{
            background:white;
            padding:10px;
            border-bottom:1px solid #ddd;
        }
    </style>

</head>

<body>

<div class="container-fluid">
<div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar">

        <h4 class="p-3">Horizon System</h4>

        <a href="/home">Dashboard</a>

        <hr>

        <strong class="p-2">Students</strong>

        <a href="/students">All Students</a>
        <a href="/students/create">Add Student</a>

        <hr>

        <strong class="p-2">Academic</strong>

        <a href="/schools/create">Add School</a>
        <a href="/levels/create">Add Level</a>

        <hr>

        <strong class="p-2">Parents</strong>

        <a href="/guardians/create">Add Guardian</a>

    </div>

    <!-- Main Content -->
    <div class="col-md-10">

        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between">

            <h5>Admin Dashboard</h5>

            <div>
                Admin User
            </div>

        </div>

        <div class="p-4">

            @yield('content')

        </div>

    </div>

</div>
</div>

</body>
</html> --}}

<!DOCTYPE html>
<html>
<head>
    <title>Horizon Institute System | Pro Dashboard</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome 6 (free icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts: Inter & Poppins for premium typography -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ========== GLOBAL RESET & PREMIUM STYLES ========== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fc 0%, #eef2f8 100%);
            overflow-x: hidden;
        }

        /* custom scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }
        ::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #94a3b8;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        /* ========== SIDEBAR — Modern Dark Glassmorphic ========== */
        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            background: linear-gradient(145deg, #0B1120 0%, #0F172A 100%);
            backdrop-filter: blur(2px);
            color: #e2e8f0;
            transition: all 0.2s;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 12px 0 28px -12px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        /* brand logo */
        .sidebar h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #FFFFFF 0%, #A5F3FC 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin-bottom: 1.8rem;
            font-size: 1.7rem;
            padding: 1.2rem 1rem 0.8rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .sidebar h4::before {
            content: "\f19d";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            background: linear-gradient(135deg, #60A5FA, #A78BFA);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 1.5rem;
        }

        /* section labels */
        .sidebar hr {
            margin: 1rem 1.2rem;
            border-color: rgba(255, 255, 255, 0.08);
        }
        .sidebar strong {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-weight: 700;
            color: #94a3b8;
            padding-left: 1.2rem;
            margin-top: 0.8rem;
            margin-bottom: 0.6rem;
            display: block;
        }

        /* elegant links */
        .sidebar a {
            color: #cbd5e6;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.7rem 1.2rem;
            margin: 0.2rem 0.9rem;
            border-radius: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.92rem;
        }
        .sidebar a::before {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            font-size: 1.1rem;
            width: 24px;
            display: inline-block;
            color: #818cf8;
        }
        /* custom icons for each link using pseudo-elements (keeping original structure) */
        .sidebar a[href="/home"]::before { content: "\f3fd"; }      /* dashboard */
        .sidebar a[href="/students"]::before { content: "\f501"; }   /* users */
        .sidebar a[href="/students/create"]::before { content: "\f234"; } /* user-plus */
        .sidebar a[href="/schools/create"]::before { content: "\f19d"; }   /* school */
        .sidebar a[href="/levels/create"]::before { content: "\f5fd"; }     /* layer-group */
        .sidebar a[href="/guardians/create"]::before { content: "\f004"; }   /* heart */
        .sidebar a[href="/enrollments/create"]::before { content: "\f4c4"; } /* enrollment/checklist icon */
        .sidebar a[href="/camp-students"]::before { content: "\f6ba"; }      /* camp/students icon */

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
            transform: translateX(5px);
            backdrop-filter: blur(4px);
        }

        /* ========== TOPBAR — premium floating clean ========== */
        .topbar {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            padding: 0.8rem 2rem;
            border-bottom: 1px solid rgba(203, 213, 225, 0.5);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            align-items: center;
        }
        .topbar h5 {
            font-weight: 700;
            font-size: 1.35rem;
            background: linear-gradient(135deg, #1E293B, #2D3A4E);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            letter-spacing: -0.2px;
            margin: 0;
        }
        .topbar div:last-child {
            background: #f1f5f9;
            padding: 0.45rem 1.1rem;
            border-radius: 40px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .topbar div:last-child::before {
            content: "\f2bd";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            color: #3b82f6;
        }

        /* ========== MAIN PANEL — premium cards & spacing ========== */
        .col-md-10 {
            background: #f8fafd;
        }
        .p-4 {
            padding: 2rem 2rem !important;
        }
        @media (max-width: 768px) {
            .p-4 {
                padding: 1.2rem !important;
            }
            .topbar {
                padding: 0.6rem 1rem;
            }
        }

        /* content wrapper: makes yield area elegant */
        .dashboard-content-area {
            animation: fadeSlideUp 0.3s ease-out;
        }
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* card styling for dynamic content */
        .card-premium {
            background: white;
            border-radius: 28px;
            border: none;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.03), 0 2px 4px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-premium:hover {
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.08);
        }

        /* demo enhancement for any table / form inside yield */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 8px;
        }
        .table-modern th {
            font-weight: 600;
            color: #1e293b;
            border-bottom: 2px solid #eef2ff;
            padding: 0.8rem 0.5rem;
        }
        .table-modern td {
            background: white;
            padding: 1rem 0.5rem;
            border-radius: 16px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .btn-modern {
            border-radius: 40px;
            padding: 0.5rem 1.4rem;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary-soft {
            background: #0f172a;
            color: white;
            border: none;
        }
        .btn-primary-soft:hover {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(15,23,42,0.12);
        }
        /* status badge */
        .badge-soft {
            background: #eef2ff;
            color: #1e40af;
            padding: 0.3rem 0.9rem;
            border-radius: 30px;
            font-weight: 500;
            font-size: 0.7rem;
        }
        /* form inputs */
        input, select, textarea {
            border-radius: 20px !important;
            border: 1px solid #e2e8f0 !important;
            padding: 0.6rem 1rem !important;
            transition: all 0.2s;
        }
        input:focus, select:focus {
            border-color: #818cf8 !important;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2) !important;
            outline: none;
        }
    </style>
</head>
<body>

<div class="container-fluid">
<div class="row">

    <!-- Sidebar (exactly same HTML structure, only style upgraded) -->
    <div class="col-md-2 sidebar">

        <h4 class="p-3">Horizon System</h4>

        <a href="/home">Dashboard</a>

        <hr>

        <strong class="p-2">Students</strong>

        <a href="/students">All Students</a>
        <a href="/students/create">Add Student</a>
        <a href="/camp-students">Camp Students</a>


        <hr>


        <strong class="p-2">Enrollments</strong>

        <a href="/enrollments/create">Enroll Student</a>

        <hr>

        <strong class="p-2">Academic</strong>

        <a href="/schools/create">Add School</a>
        <a href="/levels/create">Add Level</a>
        
        <hr>

        <strong class="p-2">Parents</strong>

        <a href="/guardians/create">Add Guardian</a>

    </div>

    <!-- Main Content -->
    <div class="col-md-10">

        <!-- Topbar (original layout, upgraded visually) -->
        <div class="topbar d-flex justify-content-between">

            <h5>Admin Dashboard</h5>

            <div>
                Admin User
            </div>

        </div>

        <div class="p-4 dashboard-content-area">

            @yield('content')
{{-- 
            
            <!-- this part shows a beautiful preview when no dynamic blade content exists -->
            <div class="card-premium p-4" style="background: white; border-radius: 28px;">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>
                        <h2 style="font-weight: 700; color: #0f172a;">Welcome back, <span style="background: linear-gradient(135deg,#3b82f6,#8b5cf6); -webkit-background-clip:text; background-clip:text; color:transparent;">Horizon Director</span> 👋</h2>
                        <p class="text-secondary mt-1">Smart insights & academic overview</p>
                    </div>
                    <div>
                        <button class="btn btn-primary-soft btn-modern" id="demoInsightBtn"><i class="fas fa-chart-line me-2"></i>Analytics</button>
                    </div>
                </div>

                <!-- stats row -->
                <div class="row g-4 mb-5">
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-4 bg-white border" style="box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                            <span class="text-secondary">Total Students</span>
                            <h3 class="fw-bold mt-1 mb-0">1,284</h3>
                            <small class="text-success"><i class="fas fa-arrow-up me-1"></i>+8.2%</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-4 bg-white border" style="box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                            <span class="text-secondary">Schools</span>
                            <h3 class="fw-bold mt-1 mb-0">8</h3>
                            <small class="text-muted">+2 new</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-4 bg-white border" style="box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                            <span class="text-secondary">Guardians</span>
                            <h3 class="fw-bold mt-1 mb-0">973</h3>
                            <small class="text-info">active</small>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="p-3 rounded-4 bg-white border" style="box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                            <span class="text-secondary">Levels</span>
                            <h3 class="fw-bold mt-1 mb-0">24</h3>
                            <small class="text-muted">K-12+</small>
                        </div>
                    </div>
                </div>

                <!-- recent table placeholder -->
                <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
                    <h5 class="fw-semibold m-0"><i class="fas fa-user-graduate me-2 text-primary"></i>Recently Enrolled</h5>
                    <a href="#" class="text-decoration-none small fw-semibold">View all →</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern align-middle w-100">
                        <thead>
                            <tr><th>ID</th><th>Full Name</th><th>School</th><th>Level</th><th>Status</th><th>Guardian</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>HZ-1024</td><td><i class="fas fa-circle-user me-2 text-secondary"></i>Emma Watson</td><td>Horizon High</td><td>Grade 11</td><td><span class="badge-soft">Active</span></td><td>Clara Watson</td></tr>
                            <tr><td>HZ-1025</td><td><i class="fas fa-circle-user me-2 text-secondary"></i>Liam Chen</td><td>Innovation Academy</td><td>Grade 9</td><td><span class="badge-soft bg-light text-dark">Pending</span></td><td>Michael Chen</td></tr>
                            <tr><td>HZ-1026</td><td><i class="fas fa-circle-user me-2 text-secondary"></i>Sofia Rodriguez</td><td>STEM Institute</td><td>Grade 12</td><td><span class="badge-soft">Active</span></td><td>Elena Rodriguez</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-light border-0 bg-opacity-10 mt-3 p-3 rounded-4 d-flex align-items-center" style="background: #f1f5f9;">
                    <i class="fas fa-gem text-primary me-3 fs-5"></i>
                    <div class="small">Horizon System — complete academic management. Use sidebar to manage students, schools, levels & guardians.</div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
</div>

<!-- Tiny interactive script to enhance dashboard demo & show that design stays professional -->
<script>
    (function() {
        // add live date to topbar? optional but cool
        const adminDiv = document.querySelector('.topbar div:last-child');
        if(adminDiv && !adminDiv.querySelector('.date-badge')) {
            const dateSpan = document.createElement('span');
            dateSpan.className = 'ms-2 text-secondary small d-none d-md-inline';
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            dateSpan.innerText = new Date().toLocaleDateString(undefined, options);
            dateSpan.style.fontSize = '0.7rem';
            adminDiv.appendChild(dateSpan);
        }

        // make sidebar links interactive to simulate route but preserving style (just adds active effect)
        const allLinks = document.querySelectorAll('.sidebar a');
        allLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // just a stylish active state, no page reload – only to keep demo elegance
                allLinks.forEach(l => l.style.background = '');
                this.style.background = 'rgba(255, 255, 255, 0.12)';
                this.style.transform = 'translateX(2px)';
                // optional small feedback for demo (no actual routing, just ux)
                const mainContentDiv = document.querySelector('.dashboard-content-area');
                if(mainContentDiv && !this.getAttribute('data-msg')) {
                    const fakeToast = document.createElement('div');
                    fakeToast.className = 'position-fixed bottom-0 end-0 m-3 bg-white shadow-lg rounded-4 p-3 d-flex align-items-center gap-2';
                    fakeToast.style.zIndex = '1090';
                    fakeToast.style.borderLeft = '4px solid #3b82f6';
                    fakeToast.innerHTML = `<i class="fas fa-check-circle text-success"></i> <span class="small fw-medium">${this.innerText.trim()} — ready to manage</span> <i class="fas fa-times-circle ms-2 text-muted" style="cursor:pointer"></i>`;
                    document.body.appendChild(fakeToast);
                    setTimeout(() => fakeToast.remove(), 1800);
                    const closeBtn = fakeToast.querySelector('.fa-times-circle');
                    if(closeBtn) closeBtn.onclick = () => fakeToast.remove();
                }
            });
        });

        // insight button demo (enhance)
        const insightBtn = document.getElementById('demoInsightBtn');
        if(insightBtn) {
            insightBtn.addEventListener('click', () => {
                alert("✨ Horizon Analytics: 1,284 total students, 87% attendance rate, +12% growth this semester.");
            });
        }
    })();
</script>

<!-- Bootstrap JS bundle for any interactivity (optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
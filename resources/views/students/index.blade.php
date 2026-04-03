{{-- @extends('layouts.app')

@section('content')

<h3 class="mb-4">Students List</h3>

<a href="/students/create" class="btn btn-primary mb-3">Add Student</a>

<table class="table table-bordered table-striped">

<tr>
<th>ID</th>
<th>Name</th>
<th>Gender</th>
<th>School</th>
<th>Level</th>
<th>Guardian</th>
</tr>

@foreach($students as $student)

<tr>
<td>{{ $student->id }}</td>
<td>{{ $student->full_name }}</td>
<td>{{ $student->gender }}</td>
<td>{{ $student->school->name }}</td>
<td>{{ $student->level->name }}</td>
<td>{{ $student->guardian->full_name }}</td>
</tr>

@endforeach

</table>

@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="text-primary mb-0">
                <i class="fas fa-users me-2"></i>Students List
            </h3>
            <p class="text-muted mt-2 mb-0">Manage and view all student records</p>
        </div>
        <a href="{{ route('students.create') }}" class="btn btn-primary btn-lg shadow-sm">
            <i class="fas fa-user-plus me-2"></i>Add New Student
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Total Students</h6>
                            <h2 class="mb-0">{{ $students->count() }}</h2>
                        </div>
                        <i class="fas fa-user-graduate fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Male Students</h6>
                            <h2 class="mb-0">{{ $students->where('gender', 'Male')->count() }}</h2>
                        </div>
                        <i class="fas fa-mars fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Female Students</h6>
                            <h2 class="mb-0">{{ $students->where('gender', 'Female')->count() }}</h2>
                        </div>
                        <i class="fas fa-venus fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-0 shadow-sm bg-gradient-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-white-50 mb-1">Schools</h6>
                            <h2 class="mb-0">{{ $students->unique('school_id')->count() }}</h2>
                        </div>
                        <i class="fas fa-school fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search by name or guardian...">
                    </div>
                </div>
                <div class="col-md-3">
                    <select id="genderFilter" class="form-select">
                        <option value="">All Genders</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="schoolFilter" class="form-select">
                        <option value="">All Schools</option>
                        @foreach($students->unique('school_id') as $student)
                            <option value="{{ $student->school->name }}">{{ $student->school->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button id="resetFilters" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-undo-alt me-1"></i>Reset
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="studentsTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3 px-4" width="80">
                                <i class="fas fa-hashtag me-1"></i>ID
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-user me-1"></i>Student Name
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-venus-mars me-1"></i>Gender
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-school me-1"></i>School
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-layer-group me-1"></i>Level
                            </th>
                            <th class="border-0 py-3">
                                <i class="fas fa-user-tie me-1"></i>Guardian
                            </th>
                            <th class="border-0 py-3 text-center" width="120">
                                <i class="fas fa-cog me-1"></i>Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr class="student-row">
                            <td class="px-4">
                                <span class="badge bg-secondary bg-opacity-10 text-dark px-3 py-2">
                                    #{{ $student->id }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        {{ strtoupper(substr($student->full_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $student->full_name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            @if($student->date_of_birth)
                                                {{ \Carbon\Carbon::parse($student->date_of_birth)->age }} years old
                                            @endif
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($student->gender == 'Male')
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                        <i class="fas fa-mars me-1"></i>Male
                                    </span>
                                @else
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                                        <i class="fas fa-venus me-1"></i>Female
                                    </span>
                                @endif
                            </td>
                            <td>
                                <i class="fas fa-building text-primary me-1"></i>
                                {{ $student->school->name ?? 'N/A' }}
                            </td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                    {{ $student->level->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td>
                                <i class="fas fa-user-circle text-secondary me-1"></i>
                                {{ $student->guardian->full_name ?? 'N/A' }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    @if(Route::has('students.show'))
                                        <a href="{{ route('students.show', $student->id) }}" 
                                           class="btn btn-sm btn-outline-info" 
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    
                                    @if(Route::has('students.edit'))
                                        <a href="{{ route('students.edit', $student->id) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           title="Edit Student">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                    
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Delete Student"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal"
                                            data-student-id="{{ $student->id }}"
                                            data-student-name="{{ $student->full_name }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No students found</h5>
                                <p class="text-muted">Click "Add New Student" to get started</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Table Footer with Pagination Info -->
        @if(method_exists($students, 'hasPages') && $students->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Showing {{ $students->firstItem() ?? 0 }} to {{ $students->lastItem() ?? 0 }} of {{ $students->total() }} students
                </div>
                <div>
                    {{ $students->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="deleteStudentName"></strong>?</p>
                <p class="text-muted small mb-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" action="" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Student</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #fbc2eb 0%, #a6c1ee 100%);
    }
    
    .avatar-circle {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 14px;
    }
    
    .table th {
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table tbody tr {
        transition: all 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .badge {
        font-weight: 500;
        border-radius: 8px;
    }
    
    .btn-group .btn {
        border-radius: 6px;
        margin: 0 2px;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-1px);
    }
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .table-responsive {
        border-radius: 15px;
    }
    
    .pagination {
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script>
    // Search and Filter Functionality
    function filterTable() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const genderFilter = document.getElementById('genderFilter').value;
        const schoolFilter = document.getElementById('schoolFilter').value;
        
        const rows = document.querySelectorAll('.student-row');
        
        rows.forEach(row => {
            const name = row.cells[1]?.innerText.toLowerCase() || '';
            const guardian = row.cells[5]?.innerText.toLowerCase() || '';
            const gender = row.cells[2]?.innerText || '';
            const school = row.cells[3]?.innerText || '';
            
            const matchesSearch = name.includes(searchTerm) || guardian.includes(searchTerm);
            const matchesGender = !genderFilter || gender.includes(genderFilter);
            const matchesSchool = !schoolFilter || school === schoolFilter;
            
            if (matchesSearch && matchesGender && matchesSchool) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    const searchInput = document.getElementById('searchInput');
    const genderFilter = document.getElementById('genderFilter');
    const schoolFilter = document.getElementById('schoolFilter');
    const resetBtn = document.getElementById('resetFilters');
    
    if (searchInput) searchInput.addEventListener('keyup', filterTable);
    if (genderFilter) genderFilter.addEventListener('change', filterTable);
    if (schoolFilter) schoolFilter.addEventListener('change', filterTable);
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            if (genderFilter) genderFilter.value = '';
            if (schoolFilter) schoolFilter.value = '';
            filterTable();
        });
    }
    
    // Delete Modal Handler
    const deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const studentId = button.getAttribute('data-student-id');
            const studentName = button.getAttribute('data-student-name');
            
            document.getElementById('deleteStudentName').textContent = studentName;
            document.getElementById('deleteForm').action = `/students/${studentId}`;
        });
    }
</script>
@endpush
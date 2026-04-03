{{-- @extends('layouts.app')

@section('content')
<h1>Add Student</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('students.store') }}" method="POST">
    @csrf
    <label>Full Name</label>
    <input type="text" name="full_name" value="{{ old('full_name') }}"><br>

    <label>Gender</label>
    <select name="gender">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select><br>

    <label>Date of Birth</label>
    <input type="date" name="date_of_birth"><br>

    <label>School</label>
    <select name="school_id">
        @foreach($schools as $school)
            <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach
    </select><br>
    <a href="{{ route('schools.create') }}">Add New School</a><br>

    <label>Level</label>
    <select name="level_id">
        @foreach($levels as $level)
            <option value="{{ $level->id }}">{{ $level->name }}</option>
        @endforeach
    </select><br>
    <a href="{{ route('levels.create') }}">Add New Level</a><br>


    <label>Guardian</label>
    <select name="guardian_id">
        @foreach($guardians as $guardian)
            <option value="{{ $guardian->id }}">{{ $guardian->full_name }}</option>
        @endforeach
    </select><br>
    <a href="{{ route('guardians.create') }}">Add New Guardian</a><br>

    <button type="submit">Add Student</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-graduate fs-3 me-2"></i>
                        <h1 class="h3 mb-0">Add New Student</h1>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex">
                                <i class="fas fa-exclamation-circle me-2 mt-1"></i>
                                <div>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('students.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="mb-4 pb-2 border-bottom">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-info-circle me-2"></i>Basic Information
                            </h5>
                        </div>

                        <div class="mb-3">
                            <label for="full_name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>Full Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('full_name') is-invalid @enderror" 
                                   id="full_name" 
                                   name="full_name" 
                                   value="{{ old('full_name') }}" 
                                   placeholder="Enter student's full name"
                                   autofocus>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label fw-semibold">
                                    <i class="fas fa-venus-mars me-1"></i>Gender <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label fw-semibold">
                                    <i class="fas fa-calendar-alt me-1"></i>Date of Birth <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control @error('date_of_birth') is-invalid @enderror" 
                                       id="date_of_birth" 
                                       name="date_of_birth" 
                                       value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Academic Information Section -->
                        <div class="mb-4 pb-2 border-bottom mt-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-graduation-cap me-2"></i>Academic Information
                            </h5>
                        </div>

                        <div class="mb-3">
                            <label for="school_id" class="form-label fw-semibold">
                                <i class="fas fa-school me-1"></i>School <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <select class="form-select @error('school_id') is-invalid @enderror" id="school_id" name="school_id">
                                    <option value="">Select a school</option>
                                    @foreach($schools as $school)
                                        <option value="{{ $school->id }}" {{ old('school_id') == $school->id ? 'selected' : '' }}>
                                            {{ $school->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ route('schools.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Add New
                                </a>
                            </div>
                            @error('school_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="level_id" class="form-label fw-semibold">
                                <i class="fas fa-layer-group me-1"></i>Education Level <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <select class="form-select @error('level_id') is-invalid @enderror" id="level_id" name="level_id">
                                    <option value="">Select a level</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ route('levels.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Add New
                                </a>
                            </div>
                            @error('level_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Guardian Information Section -->
                        <div class="mb-4 pb-2 border-bottom mt-4">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-users me-2"></i>Guardian Information
                            </h5>
                        </div>

                        <div class="mb-4">
                            <label for="guardian_id" class="form-label fw-semibold">
                                <i class="fas fa-user-tie me-1"></i>Guardian <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <select class="form-select @error('guardian_id') is-invalid @enderror" id="guardian_id" name="guardian_id">
                                    <option value="">Select a guardian</option>
                                    @foreach($guardians as $guardian)
                                        <option value="{{ $guardian->id }}" {{ old('guardian_id') == $guardian->id ? 'selected' : '' }}>
                                            {{ $guardian->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ route('guardians.create') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-plus me-1"></i>Add New
                                </a>
                            </div>
                            @error('guardian_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i>Add Student
                            </button>
                        </div>
                    </form>
                </div>
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
    
    .card {
        border-radius: 15px;
        overflow: hidden;
    }
    
    .form-label {
        font-weight: 500;
        color: #2d3748;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }
    
    .btn-outline-primary:hover {
        transform: translateY(-1px);
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .alert {
        border-radius: 12px;
        border: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Bootstrap form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush
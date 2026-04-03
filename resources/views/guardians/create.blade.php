{{-- @extends('layouts.app')

@section('content')
<h1>Add New Guardian</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('guardians.store') }}" method="POST">
    @csrf
    <label>Full Name</label>
    <input type="text" name="full_name" value="{{ old('full_name') }}"><br>

    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone') }}"><br>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email') }}"><br>

    <label>Address</label>
    <input type="text" name="address" value="{{ old('address') }}"><br>

    <button type="submit">Add Guardian</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white py-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-white bg-opacity-20 p-3 me-3">
                            <i class="fas fa-user-shield fa-2x text-white"></i>
                        </div>
                       <div>
                             <h1 class="text-secondary mb-0 mt-1">Add New Guardian</h1>
                             <p class="text-secondary mb-0 mt-1">Register a guardian for student records</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle fa-lg me-2"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle fa-lg me-2 mt-1"></i>
                                <div>
                                    <strong>Please fix the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('guardians.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <!-- Guardian Information Section -->
                        <div class="mb-4 pb-2 border-bottom">
                            <h5 class="text-primary mb-0">
                                <i class="fas fa-info-circle me-2"></i>Guardian Information
                            </h5>
                            <p class="text-muted small mt-1">Please provide the guardian's complete details</p>
                        </div>

                        <!-- Full Name Field -->
                        <div class="mb-4">
                            <label for="full_name" class="form-label fw-semibold">
                                <i class="fas fa-user me-1"></i>Full Name 
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('full_name') is-invalid @enderror" 
                                       id="full_name" 
                                       name="full_name" 
                                       value="{{ old('full_name') }}" 
                                       placeholder="Enter guardian's full name"
                                       autofocus>
                            </div>
                            @error('full_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @else
                                <small class="text-muted">Example: John M. Doe</small>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="mb-4">
                            <label for="phone" class="form-label fw-semibold">
                                <i class="fas fa-phone-alt me-1"></i>Phone Number 
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-phone text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}" 
                                       placeholder="+1234567890">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @else
                                <small class="text-muted">Include country code for international numbers</small>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold">
                                <i class="fas fa-envelope me-1"></i>Email Address 
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="guardian@example.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @else
                                <small class="text-muted">We'll send important notifications to this email</small>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt me-1"></i>Address 
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-location-dot text-muted"></i>
                                </span>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3" 
                                          placeholder="Enter full address">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @else
                                <small class="text-muted">Full residential or postal address</small>
                            @enderror
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                            <a href="{{ Route::has('guardians.index') ? route('guardians.index') : url('/guardians') }}" class="btn btn-secondary px-4">
                                <i class="fas fa-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-5">
                                <i class="fas fa-save me-2"></i>Add Guardian
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Info Card -->
            <div class="card border-0 shadow-sm mt-4 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle fa-2x text-primary"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Important Notes</h6>
                            <p class="text-muted small mb-0">
                                All fields marked with <span class="text-danger">*</span> are required. 
                                The guardian's information will be linked to student records.
                            </p>
                        </div>
                    </div>
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
    
    .bg-opacity-20 {
        background-color: rgba(255, 255, 255, 0.2);
    }
    
    .card {
        border-radius: 20px;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
    
    .form-label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .input-group-text {
        border-radius: 12px 0 0 12px;
        transition: all 0.3s ease;
    }
    
    .form-control, textarea.form-control {
        border-radius: 0 12px 12px 0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, textarea.form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    
    .input-group:focus-within .input-group-text {
        border-color: #667eea;
        background-color: #f8f9fa;
    }
    
    .btn {
        border-radius: 12px;
        font-weight: 500;
        padding: 0.6rem 1.5rem;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    
    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
    }
    
    .alert {
        border-radius: 15px;
        border: none;
        padding: 1rem 1.5rem;
    }
    
    .alert-success {
        background: linear-gradient(135deg, #d4fc79 0%, #96e6a1 100%);
        color: #1a5c2e;
    }
    
    .alert-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: #721c24;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }
    
    /* Animation for form fields */
    .form-control, textarea.form-control {
        animation: fadeInUp 0.5s ease-out;
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
    
    /* Stagger animation for form groups */
    .mb-4:nth-child(1) { animation: fadeInUp 0.3s ease-out; }
    .mb-4:nth-child(2) { animation: fadeInUp 0.4s ease-out; }
    .mb-4:nth-child(3) { animation: fadeInUp 0.5s ease-out; }
    .mb-4:nth-child(4) { animation: fadeInUp 0.6s ease-out; }
    .mb-4:nth-child(5) { animation: fadeInUp 0.7s ease-out; }
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
    
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert')
        alerts.forEach(function(alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert)
                bsAlert.close()
            }, 5000)
        })
    })
    
    // Phone number formatting (optional)
    const phoneInput = document.getElementById('phone')
    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '')
            if (value.length > 0 && value.length <= 10) {
                if (value.length <= 3) {
                    value = '(' + value
                } else if (value.length <= 6) {
                    value = '(' + value.slice(0, 3) + ') ' + value.slice(3)
                } else {
                    value = '(' + value.slice(0, 3) + ') ' + value.slice(3, 6) + '-' + value.slice(6, 10)
                }
            }
            e.target.value = value
        })
    }
</script>
@endpush
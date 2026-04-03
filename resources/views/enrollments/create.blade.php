{{-- @extends('layouts.app')

@section('content')

<h3>Enroll Student</h3>

<form method="POST" action="{{ route('enrollments.store') }}">
    @csrf

    <!-- Student -->
    <div class="mb-3">
        <label>Student</label>
        <select name="student_id" class="form-control">
            <option value="">Select Student</option>
            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->full_name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Program Type -->
    <div class="mb-3">
        <label>Program Type</label>
        <select name="type" id="type" class="form-control">
            <option value="">Select Type</option>
            <option value="camp">Camp</option>
            <option value="college">College</option>
            <option value="short_course">Short Course</option>
        </select>
    </div>

    <!-- Dynamic Program Select -->
<div class="mb-3">
    <label>Select Program</label>
    <select name="reference_id" id="programSelect" class="form-control">
        <option value="">Select Program</option>
    </select>
</div>

<!-- Level (only for camp) -->
<div class="mb-3" id="levelField" style="display:none;">
    <label>Level</label>
    <select name="level_id" class="form-control">
        @foreach($levels as $level)
            <option value="{{ $level->id }}">{{ $level->name }}</option>
        @endforeach
    </select>
</div>
    <!-- Dates -->
    <div class="mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control">
    </div>

    <div class="mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control">
    </div>

    <button class="btn btn-primary">Enroll</button>

</form>

<!-- 🔥 JavaScript -->
<script>
document.getElementById('type').addEventListener('change', function () {

    let type = this.value;
    let programSelect = document.getElementById('programSelect');
    let levelField = document.getElementById('levelField');

    // reset
    programSelect.innerHTML = '<option>Loading...</option>';
    levelField.style.display = 'none';

    fetch('/get-programs/' + type)
        .then(response => response.json())
        .then(data => {

            programSelect.innerHTML = '<option value="">Select Program</option>';

            data.forEach(item => {
                programSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
            });

            // show level only for camp
            if(type === 'camp'){
                levelField.style.display = 'block';
            }

        });
});
</script>

@endsection --}}

@extends('layouts.app')

@section('content')
<div class="enrollment-container">
    <!-- Header Section -->
    <div class="enrollment-header">
        <div class="header-icon">
            <i class="fas fa-user-plus"></i>
        </div>
        <div class="header-text">
            <h1 class="enrollment-title">Enroll Student</h1>
            <p class="enrollment-subtitle">Register a student for camps, college courses, or short programs</p>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form method="POST" action="{{ route('enrollments.store') }}" class="enrollment-form" id="enrollmentForm">
            @csrf

            <!-- Student Selection -->
            <div class="form-group">
                <label for="student_id" class="form-label">
                    <i class="fas fa-user-graduate"></i>
                    Student
                    <span class="required-badge">Required</span>
                </label>
                <div class="select-wrapper">
                    <select name="student_id" id="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                        <option value="">Select Student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->full_name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="select-icon fas fa-chevron-down"></i>
                </div>
                @error('student_id')
                    <div class="error-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Program Type Selection -->
            <div class="form-group">
                <label for="type" class="form-label">
                    <i class="fas fa-layer-group"></i>
                    Program Type
                    <span class="required-badge">Required</span>
                </label>
                <div class="program-types">
                    <div class="program-option" data-type="camp">
                        <input type="radio" name="type" id="type_camp" value="camp" class="program-radio" {{ old('type') == 'camp' ? 'checked' : '' }}>
                        <label for="type_camp" class="program-label">
                            <i class="fas fa-campground"></i>
                            <span>Camp</span>
                        </label>
                    </div>
                    <div class="program-option" data-type="college">
                        <input type="radio" name="type" id="type_college" value="college" class="program-radio" {{ old('type') == 'college' ? 'checked' : '' }}>
                        <label for="type_college" class="program-label">
                            <i class="fas fa-university"></i>
                            <span>College</span>
                        </label>
                    </div>
                    <div class="program-option" data-type="short_course">
                        <input type="radio" name="type" id="type_short" value="short_course" class="program-radio" {{ old('type') == 'short_course' ? 'checked' : '' }}>
                        <label for="type_short" class="program-label">
                            <i class="fas fa-clock"></i>
                            <span>Short Course</span>
                        </label>
                    </div>
                </div>
                @error('type')
                    <div class="error-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Dynamic Program Select -->
            <div class="form-group" id="programGroup">
                <label for="programSelect" class="form-label">
                    <i class="fas fa-book-open"></i>
                    Select Program
                    <span class="required-badge">Required</span>
                </label>
                <div class="select-wrapper">
                    <select name="reference_id" id="programSelect" class="form-select @error('reference_id') is-invalid @enderror" required disabled>
                        <option value="">First select a program type</option>
                    </select>
                    <i class="select-icon fas fa-chevron-down"></i>
                </div>
                <div class="loading-spinner" id="loadingSpinner" style="display: none;">
                    <i class="fas fa-spinner fa-spin"></i> Loading programs...
                </div>
                @error('reference_id')
                    <div class="error-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Level Field (only for camp) -->
            <div class="form-group" id="levelField" style="display: none;">
                <label for="level_id" class="form-label">
                    <i class="fas fa-chart-line"></i>
                    Level
                </label>
                <div class="select-wrapper">
                    <select name="level_id" id="level_id" class="form-select @error('level_id') is-invalid @enderror">
                        <option value="">Select Level</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                {{ $level->name }}
                            </option>
                        @endforeach
                    </select>
                    <i class="select-icon fas fa-chevron-down"></i>
                </div>
                @error('level_id')
                    <div class="error-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Date Fields Row -->
            <div class="date-row">
                <div class="form-group half-width">
                    <label for="start_date" class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                        Start Date
                    </label>
                    <input type="date" name="start_date" id="start_date" class="form-input date-input @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="error-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group half-width">
                    <label for="end_date" class="form-label">
                        <i class="fas fa-calendar-check"></i>
                        End Date
                    </label>
                    <input type="date" name="end_date" id="end_date" class="form-input date-input @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                    @error('end_date')
                        <div class="error-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i>
                    <span>Enroll Student</span>
                </button>
                <a href="{{ url()->previous() }}" class="btn-cancel">
                    <i class="fas fa-times"></i>
                    <span>Cancel</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="info-card">
        <i class="fas fa-info-circle"></i>
        <div class="info-content">
            <strong>Enrollment Guide:</strong> Select a student and program type, then choose from the available programs. For camp enrollments, you'll also need to select the appropriate level.
        </div>
    </div>
</div>

<style>
    /* Container */
    .enrollment-container {
        max-width: 800px;
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
    .enrollment-header {
        display: flex;
        align-items: center;
        gap: 1.25rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #eef2ff;
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

    .enrollment-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e293b, #4f46e5);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .enrollment-subtitle {
        color: #64748b;
        margin: 0.25rem 0 0;
        font-size: 0.9rem;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 28px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05), 0 1px 2px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f2f5;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .enrollment-form {
        padding: 2rem;
    }

    /* Form Groups */
    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    .form-label i {
        color: #4f46e5;
        font-size: 0.9rem;
    }

    .required-badge {
        background: #fee2e2;
        color: #dc2626;
        font-size: 0.65rem;
        font-weight: 600;
        padding: 0.2rem 0.6rem;
        border-radius: 30px;
        margin-left: 0.5rem;
    }

    /* Select Wrapper */
    .select-wrapper {
        position: relative;
    }

    .form-select {
        width: 100%;
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        background: white;
        appearance: none;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #1e293b;
    }

    .form-select:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-select.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .form-select:disabled {
        background: #f8fafc;
        cursor: not-allowed;
        color: #94a3b8;
    }

    .select-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        font-size: 0.8rem;
    }

    /* Loading Spinner */
    .loading-spinner {
        margin-top: 0.5rem;
        font-size: 0.8rem;
        color: #4f46e5;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .loading-spinner i {
        font-size: 0.8rem;
    }

    /* Program Types (Radio Cards) */
    .program-types {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .program-option {
        position: relative;
    }

    .program-radio {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .program-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 20px;
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
    }

    .program-label i {
        font-size: 1.5rem;
        color: #64748b;
        transition: color 0.2s;
    }

    .program-label span {
        font-weight: 500;
        font-size: 0.85rem;
        color: #475569;
    }

    .program-radio:checked + .program-label {
        background: linear-gradient(135deg, #eef2ff, #e0e7ff);
        border-color: #4f46e5;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.15);
    }

    .program-radio:checked + .program-label i {
        color: #4f46e5;
    }

    .program-radio:checked + .program-label span {
        color: #4f46e5;
        font-weight: 600;
    }

    .program-label:hover {
        border-color: #cbd5e1;
        background: #f1f5f9;
        transform: translateY(-2px);
    }

    /* Input Fields */
    .form-input {
        width: 100%;
        padding: 0.85rem 1rem;
        font-size: 0.95rem;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.2s ease;
        background: white;
        color: #1e293b;
    }

    .form-input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .form-input.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .date-input {
        font-family: 'Inter', monospace;
    }

    /* Date Row */
    .date-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 0;
    }

    .half-width {
        flex: 1;
    }

    /* Error Feedback */
    .error-feedback {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .error-feedback::before {
        content: "⚠";
        font-size: 0.7rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #f1f5f9;
    }

    .btn-submit {
        flex: 1;
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        border: none;
        padding: 0.85rem 1.5rem;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-cancel {
        flex: 1;
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 0.85rem 1.5rem;
        border-radius: 40px;
        font-weight: 600;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #1e293b;
        text-decoration: none;
    }

    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 20px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #bfdbfe;
    }

    .info-card i {
        font-size: 1.5rem;
        color: #3b82f6;
    }

    .info-content {
        flex: 1;
        font-size: 0.85rem;
        color: #1e40af;
        line-height: 1.4;
    }

    .info-content strong {
        font-weight: 700;
    }

    /* Animations */
    @keyframes fadeSlide {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dynamic-section {
        animation: fadeSlide 0.3s ease-out;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .enrollment-container {
            margin: 0;
        }

        .enrollment-form {
            padding: 1.5rem;
        }

        .enrollment-title {
            font-size: 1.4rem;
        }

        .program-types {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .date-row {
            flex-direction: column;
            gap: 1.75rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit, .btn-cancel {
            width: 100%;
        }

        .enrollment-header {
            gap: 0.75rem;
        }

        .header-icon {
            width: 48px;
            height: 48px;
        }

        .header-icon i {
            font-size: 1.4rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const programSelect = document.getElementById('programSelect');
    const levelField = document.getElementById('levelField');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const submitBtn = document.getElementById('submitBtn');

    // Function to load programs based on selected type
    function loadPrograms(type) {
        // Reset program select
        programSelect.innerHTML = '<option value="">Select Program</option>';
        programSelect.disabled = true;
        
        // Hide level field initially
        if (levelField) {
            levelField.style.display = 'none';
        }
        
        // If no type selected, return
        if (!type || type === '') {
            programSelect.innerHTML = '<option value="">First select a program type</option>';
            return;
        }
        
        // Show loading spinner
        if (loadingSpinner) {
            loadingSpinner.style.display = 'block';
        }
        
        // Fetch programs from server
        fetch('/get-programs/' + type)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Clear and populate program select
                programSelect.innerHTML = '<option value="">Select Program</option>';
                
                if (data && data.length > 0) {
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.name;
                        programSelect.appendChild(option);
                    });
                    programSelect.disabled = false;
                } else {
                    programSelect.innerHTML = '<option value="">No programs available</option>';
                    programSelect.disabled = true;
                }
                
                // Show level field only for camp
                if (type === 'camp') {
                    if (levelField) {
                        levelField.style.display = 'block';
                        levelField.classList.add('dynamic-section');
                    }
                } else {
                    if (levelField) {
                        levelField.style.display = 'none';
                    }
                }
                
                // Hide loading spinner
                if (loadingSpinner) {
                    loadingSpinner.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error loading programs:', error);
                programSelect.innerHTML = '<option value="">Error loading programs</option>';
                programSelect.disabled = true;
                
                if (loadingSpinner) {
                    loadingSpinner.style.display = 'none';
                }
            });
    }
    
    // Add change event listeners to radio buttons
    typeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.checked) {
                loadPrograms(this.value);
            }
        });
    });
    
    // Check if there's an old value and load programs on page load
    const checkedRadio = document.querySelector('input[name="type"]:checked');
    if (checkedRadio) {
        loadPrograms(checkedRadio.value);
    }
    
    // Form validation before submit
    const form = document.getElementById('enrollmentForm');
    form.addEventListener('submit', function(e) {
        const studentId = document.getElementById('student_id').value;
        const type = document.querySelector('input[name="type"]:checked');
        const programId = programSelect.value;
        
        if (!studentId) {
            e.preventDefault();
            alert('Please select a student.');
            return false;
        }
        
        if (!type) {
            e.preventDefault();
            alert('Please select a program type.');
            return false;
        }
        
        if (!programId) {
            e.preventDefault();
            alert('Please select a program.');
            return false;
        }
        
        // Show loading state on button
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Enrolling...</span>';
        
        return true;
    });
});
</script>
@endsection
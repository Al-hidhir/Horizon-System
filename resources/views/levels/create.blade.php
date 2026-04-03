{{-- @extends('layouts.app')

@section('content')
<h1>Add New Level</h1>

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

<form action="{{ route('levels.store') }}" method="POST">
    @csrf
    <label>Level Name</label>
    <input type="text" name="name" value="{{ old('name') }}"><br>
    <button type="submit">Add Level</button>
</form>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="level-container">
    <!-- Header Section -->
    <div class="level-header">
        <div class="header-icon">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="header-text">
            <h1 class="level-title">Add New Level</h1>
            <p class="level-subtitle">Create academic levels for your institution's curriculum structure</p>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif

    <!-- Error Messages -->
    @if ($errors->any())
        <div class="alert-error">
            <div class="error-header">
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-circle"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('levels.store') }}" method="POST" class="level-form" id="levelForm">
            @csrf

            <div class="form-group">
                <label for="level_name" class="form-label">
                    <i class="fas fa-tag"></i>
                    Level Name
                    <span class="required-badge">Required</span>
                </label>
                <div class="input-wrapper">
                    <input 
                        type="text" 
                        name="name" 
                        id="level_name" 
                        value="{{ old('name') }}" 
                        class="form-input @error('name') is-invalid @enderror"
                        placeholder="e.g., Form 1, Form 2, Form 3, Form 4"
                        autocomplete="off"
                        autofocus
                        maxlength="100"
                    >
                    {{-- <i class="input-icon fas fa-pen"></i> --}}
                </div>
                <small class="form-hint">Enter a descriptive name for the academic level</small>
            </div>

            <!-- Additional Info Section (Optional - shows professional touch) -->
            <div class="form-group optional-group">
                <label class="form-label">
                    <i class="fas fa-info-circle"></i>
                    Additional Information (Optional)
                </label>
                <div class="input-wrapper">
                    <textarea 
                        name="description" 
                        id="level_description" 
                        class="form-textarea"
                        placeholder="Add a brief description of this academic level..."
                        rows="3"
                    >{{ old('description') }}</textarea>
                    {{-- <i class="input-icon textarea-icon fas fa-align-left"></i> --}}
                </div>
                <small class="form-hint">Optional: Provide details about the curriculum, requirements, or target students</small>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit" id="submitBtn">
                    <i class="fas fa-save"></i>
                    <span>Add Level</span>
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
        <i class="fas fa-lightbulb"></i>
        <div class="info-content">
            <strong>Pro Tip:</strong> Academic levels help organize your curriculum. Common levels include Grade 1-12, Foundation Year, Diploma Year 1-3, or customized levels for your institution.
        </div>
    </div>

    <!-- Quick Reference Card -->
    <div class="reference-card">
        <div class="reference-header">
            <i class="fas fa-chart-simple"></i>
            <strong>Level Examples</strong>
        </div>
        <div class="reference-tags">
            <span class="tag">Grade 1</span>
            <span class="tag">Grade 2</span>
            <span class="tag">Grade 3</span>
            <span class="tag">Form 1</span>
            <span class="tag">Form 2</span>
            <span class="tag">Form 3</span>
            <span class="tag">Foundation</span>
            <span class="tag">Beginner</span>
            <span class="tag">Intermediate</span>
            <span class="tag">Advanced</span>
            <span class="tag">Diploma Year 1</span>
            <span class="tag">Diploma Year 2</span>
        </div>
    </div>
</div>

<style>
    /* Container */
    .level-container {
        max-width: 720px;
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

    /* Header Section */
    .level-header {
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

    .level-title {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(135deg, #1e293b, #4f46e5);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
        margin: 0;
        letter-spacing: -0.3px;
    }

    .level-subtitle {
        color: #64748b;
        margin: 0.25rem 0 0;
        font-size: 0.9rem;
    }

    /* Success Alert */
    .alert-success {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #10b981;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideIn 0.3s ease-out;
    }

    .alert-success i {
        font-size: 1.25rem;
        color: #10b981;
    }

    .alert-success span {
        flex: 1;
        color: #065f46;
        font-weight: 500;
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #6b7280;
        transition: color 0.2s;
    }

    .alert-close:hover {
        color: #374151;
    }

    /* Error Alert */
    .alert-error {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-left: 4px solid #ef4444;
        border-radius: 16px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        animation: slideIn 0.3s ease-out;
    }

    .error-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
    }

    .error-header i {
        color: #ef4444;
        font-size: 1rem;
    }

    .error-header strong {
        color: #991b1b;
        font-size: 0.9rem;
    }

    .error-list {
        margin: 0;
        padding-left: 1.5rem;
        list-style: none;
    }

    .error-list li {
        color: #b91c1c;
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-list li i {
        font-size: 0.4rem;
        color: #ef4444;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(-10px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
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

    .level-form {
        padding: 2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.75rem;
    }

    .optional-group {
        margin-top: 1.5rem;
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

    /* Input Wrapper */
    .input-wrapper {
        position: relative;
    }

    .form-input {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.8rem;
        font-size: 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.2s ease;
        background: #ffffff;
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

    .form-textarea {
        width: 100%;
        padding: 0.9rem 1rem 0.9rem 2.8rem;
        font-size: 0.95rem;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        transition: all 0.2s ease;
        background: #ffffff;
        color: #1e293b;
        resize: vertical;
        font-family: 'Inter', sans-serif;
    }

    .form-textarea:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
        pointer-events: none;
        transition: color 0.2s;
    }

    .textarea-icon {
        top: 1.2rem;
        transform: none;
    }

    .form-input:focus + .input-icon,
    .form-textarea:focus + .input-icon {
        color: #4f46e5;
    }

    .form-hint {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: #94a3b8;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1rem;
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
        background: linear-gradient(135deg, #fefce8, #fef3c7);
        border-radius: 20px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #fde68a;
        margin-bottom: 1rem;
    }

    .info-card i {
        font-size: 1.5rem;
        color: #d97706;
    }

    .info-content {
        flex: 1;
        font-size: 0.85rem;
        color: #92400e;
        line-height: 1.4;
    }

    .info-content strong {
        font-weight: 700;
    }

    /* Reference Card */
    .reference-card {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1rem 1.25rem;
        border: 1px solid #e2e8f0;
    }

    .reference-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
        font-size: 0.85rem;
        color: #475569;
    }

    .reference-header i {
        color: #4f46e5;
        font-size: 1rem;
    }

    .reference-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .tag {
        background: white;
        padding: 0.4rem 0.9rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 500;
        color: #4f46e5;
        border: 1px solid #e2e8f0;
        transition: all 0.2s;
    }

    .tag:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        transform: translateY(-1px);
    }

    /* Responsive */
    @media (max-width: 640px) {
        .level-container {
            margin: 0;
        }

        .level-form {
            padding: 1.5rem;
        }

        .level-title {
            font-size: 1.4rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-submit, .btn-cancel {
            width: 100%;
        }

        .level-header {
            gap: 0.75rem;
        }

        .header-icon {
            width: 48px;
            height: 48px;
        }

        .header-icon i {
            font-size: 1.4rem;
        }

        .reference-tags {
            gap: 0.4rem;
        }

        .tag {
            font-size: 0.7rem;
            padding: 0.3rem 0.7rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('levelForm');
        const submitBtn = document.getElementById('submitBtn');
        const nameInput = document.getElementById('level_name');

        // Auto-capitalize first letter of each word
        if (nameInput) {
            nameInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = this.value.replace(/\b\w/g, char => char.toUpperCase());
                }
            });
        }

        // Form validation before submit
        form.addEventListener('submit', function(e) {
            const nameValue = nameInput.value.trim();
            
            if (!nameValue) {
                e.preventDefault();
                alert('Please enter a level name.');
                nameInput.focus();
                return false;
            }
            
            // Show loading state on button
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Adding Level...</span>';
            
            return true;
        });
    });
</script>
@endsection
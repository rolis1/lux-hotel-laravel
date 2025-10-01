@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Hotel Facility Add Styles */
    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .card-title {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.6rem;
        position: relative;
        z-index: 1;
    }

    .card-body {
        padding: 40px;
        background: #fafbfc;
    }

    .form-group {
        margin-bottom: 25px;
    }

    label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 0.95rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fafbfc;
        width: 100%;
    }

    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        background: white;
        transform: translateY(-2px);
    }

    .form-control.is-invalid {
        border-color: #ff6b6b;
        box-shadow: 0 0 0 3px rgba(255, 107, 107, 0.1);
    }

    .form-control.is-valid {
        border-color: #51cf66;
        box-shadow: 0 0 0 3px rgba(81, 207, 102, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .invalid-feedback {
        font-weight: 500;
        margin-top: 8px;
        padding: 8px 12px;
        background: #fff5f5;
        border: 1px solid #ffd1d1;
        border-radius: 6px;
        color: #ff6b6b;
        display: block;
    }

    .btn-primary {
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        border: none;
        border-radius: 10px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(81, 207, 102, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(81, 207, 102, 0.4);
        background: linear-gradient(135deg, #40c057 0%, #2f9e44 100%);
    }

    .btn-primary:hover::before {
        left: 100%;
    }

    .btn-primary:active {
        transform: translateY(-1px);
    }

    .float-right {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #f1f3f4;
    }

    .row {
        margin: 0;
        width: 100%;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    /* Form container enhancements */
    form {
        max-width: 600px;
        margin: 0 auto;
    }

    /* Input focus animation */
    @keyframes inputFocus {
        0% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.1);
        }
        50% {
            transform: scale(1.02);
            box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
        }
        100% {
            transform: scale(1);
            box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
        }
    }

    .form-control:focus {
        animation: inputFocus 0.5s ease;
    }

    /* Success state styling */
    .form-control.is-valid {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8' viewBox='0 0 8 8'%3e%3cpath fill='%2351cf66' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        padding-right: 2.5rem;
    }

    /* Error state styling */
    .form-control.is-invalid {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23ff6b6b' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ff6b6b' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        padding-right: 2.5rem;
    }

    /* Add specific styling for the hotel facility page */
    .hotel-facility-highlight {
        position: relative;
    }

    .hotel-facility-highlight::after {
        content: '';
        position: absolute;
        top: 0;
        left: -10px;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        border-radius: 2px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .form-group:focus-within .hotel-facility-highlight::after {
        opacity: 1;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .card-header {
            padding: 20px;
        }
        
        .card-title {
            font-size: 1.4rem;
        }
        
        .card-body {
            padding: 25px 20px;
        }
        
        .form-control {
            padding: 10px 14px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            padding: 12px 30px;
            font-size: 0.95rem;
            width: 100%;
        }
        
        .float-right {
            justify-content: center;
        }
        
        .col-md-6 {
            width: 100%;
        }
        
        textarea.form-control {
            min-height: 80px;
        }
    }

    /* Animation for form elements */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-group {
        animation: slideIn 0.5s ease forwards;
    }

    .form-group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .form-group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .form-group:nth-child(3) {
        animation-delay: 0.3s;
    }

    /* Placeholder styling */
    .form-control::placeholder {
        color: #a0a4a8;
        font-weight: 400;
    }

    /* Label enhancement with hotel icon */
    label {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    label::before {
        content: '🏨';
        margin-right: 8px;
        font-size: 1rem;
        opacity: 0.7;
    }

    /* Description textarea specific styling */
    textarea.form-control {
        background-image: none !important;
        padding-right: 16px !important;
    }

    /* Character count for textarea */
    .char-count {
        position: absolute;
        bottom: 10px;
        right: 15px;
        font-size: 0.8rem;
        color: #6c757d;
        background: white;
        padding: 2px 6px;
        border-radius: 4px;
        pointer-events: none;
    }

    .textarea-wrapper {
        position: relative;
    }

    /* Button container styling */
    .button-container {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        align-items: center;
    }

    /* Cancel button styling */
    .btn-cancel {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        color: #6c757d;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: #e9ecef;
        color: #495057;
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Help text styling */
    .help-text {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 8px;
        font-style: italic;
    }

    /* Success message styling */
    .alert-success {
        border-radius: 10px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
        color: white;
        border-left: 5px solid #2b8a3e;
    }
</style>

<div class="card">
    <div class="card-header">
      <h3 class="card-title">FACILITY LIST</h3>
      <div class="card-tools">
        </div>
    </div>
    <div class="card-body">

        <form action="{{ route('hotelfacility.store') }}" method="post">
            @csrf
            <div class="form-group hotel-facility-highlight">
                <label for="facility_name">Facility Name</label>
                <input id="facility_name" name="facility_name" type="text" class="form-control @error('facility_name') is-invalid @enderror" value="{{ old('facility_name') }}" required autocomplete="facility_name" autofocus placeholder="Enter hotel facility name (e.g., Swimming Pool, Gym, Spa)">

                @error('facility_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="help-text">Enter the name of the hotel facility you want to add.</div>
            </div>
            
            <div class="form-group hotel-facility-highlight">
                <label for="detail">Description</label>
                <div class="textarea-wrapper">
                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror" id="detail" rows="4" required autocomplete="detail" autofocus placeholder="Describe the facility features, benefits, and any important details...">{{ old('detail') }}</textarea>
                    <div class="char-count" id="charCount">0/500</div>
                </div>

                @error('detail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="help-text">Provide a detailed description of the facility for your guests.</div>
            </div>

            <div class="form-group float-right row mb-0">
                <div class="col-md-6">
                    <div class="button-container">
                        <a href="{{ url()->previous() }}" class="btn-cancel">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Facility') }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
  </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('detail');
        const charCount = document.getElementById('charCount');
        
        if (textarea && charCount) {
            // Update character count on input
            textarea.addEventListener('input', function() {
                charCount.textContent = this.value.length + '/500';
                
                // Change color when approaching limit
                if (this.value.length > 450) {
                    charCount.style.color = '#ff6b6b';
                } else if (this.value.length > 400) {
                    charCount.style.color = '#f59f00';
                } else {
                    charCount.style.color = '#6c757d';
                }
            });
            
            // Initialize character count
            charCount.textContent = textarea.value.length + '/500';
        }
        
        // Real-time validation feedback
        const form = document.querySelector('form');
        const inputs = form.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });
            
            input.addEventListener('input', function() {
                if (this.checkValidity()) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                }
            });
        });
    });
</script>

@endsection
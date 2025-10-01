@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Room Edit Styles */
    .edit-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
    }

    .edit-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .edit-card .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .edit-card .card-header h3 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.6rem;
        position: relative;
        z-index: 1;
    }

    .edit-card .card-header h3 i {
        margin-right: 12px;
        opacity: 0.9;
    }

    .edit-card .card-body {
        padding: 40px;
        background: #fafbfc;
    }

    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-section {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        border: 1px solid #f0f0f0;
    }

    .form-section-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #667eea;
        position: relative;
    }

    .form-section-title::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }

    .form-label i {
        margin-right: 8px;
        color: #667eea;
        width: 20px;
        text-align: center;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 1px 16px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background: #fafbfc;
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

    .invalid-feedback {
        font-weight: 500;
        margin-top: 8px;
        padding: 8px 12px;
        background: #fff5f5;
        border: 1px solid #ffd1d1;
        border-radius: 6px;
        color: #ff6b6b;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .status-indicator {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-left: 10px;
        text-transform: uppercase;
    }

    .status-available { background: #e7f6e9; color: #2b8a3e; }
    .status-reserved { background: #fff9db; color: #e67700; }
    .status-occupied { background: #ffe3e3; color: #c92a2a; }
    .status-out-of-service { background: #f1f3f5; color: #495057; }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 10px;
        padding: 14px 35px;
        font-weight: 600;
        font-size: 1rem;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-submit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .btn-submit:hover::before {
        left: 100%;
    }

    .btn-submit:active {
        transform: translateY(-1px);
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #f1f3f4;
    }

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

    /* Custom select styling */
    .custom-select-wrapper {
        position: relative;
    }

    .custom-select-wrapper::after {
        content: '▼';
        font-size: 0.8rem;
        color: #667eea;
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
    }

    /* Room preview card */
    .room-preview {
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
        border: 2px dashed #667eea;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        margin-top: 10px;
    }

    .room-preview-title {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 15px;
        font-size: 1.1rem;
    }

    .room-preview-info {
        display: flex;
        justify-content: center;
        gap: 30px;
        flex-wrap: wrap;
    }

    .preview-item {
        text-align: center;
    }

    .preview-label {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 5px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .preview-value {
        font-weight: 700;
        color: #2c3e50;
        font-size: 1.1rem;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .edit-card .card-body {
            padding: 25px 20px;
        }

        .form-section {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            text-align: center;
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

    .form-section {
        animation: slideIn 0.5s ease forwards;
    }

    .form-section:nth-child(1) { animation-delay: 0.1s; }
    .form-section:nth-child(2) { animation-delay: 0.2s; }
    .form-section:nth-child(3) { animation-delay: 0.3s; }
</style>

<div class="card edit-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-edit"></i>
            EDIT ROOM
        </h3>
    </div>
    
    <div class="card-body">
        <div class="form-container">
            <!-- Room Preview -->
            <div class="form-section">
                <div class="room-preview">
                    <div class="room-preview-title">
                        <i class="fas fa-eye mr-2"></i>Room Preview
                    </div>
                    <div class="room-preview-info">
                        <div class="preview-item">
                            <div class="preview-label">Room Number</div>
                            <div class="preview-value" id="preview-number">{{ $data->number }}</div>
                        </div>
                        <div class="preview-item">
                            <div class="preview-label">Current Status</div>
                            <div class="preview-value">
                                @if($data->status == 'v')
                                    <span class="status-indicator status-available">Available</span>
                                @elseif($data->status == 'r')
                                    <span class="status-indicator status-reserved">Reserved</span>
                                @elseif($data->status == 'o')
                                    <span class="status-indicator status-occupied">Occupied</span>
                                @elseif($data->status == 'os')
                                    <span class="status-indicator status-out-of-service">Out of Service</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('room.update', $data->id) }}" method="post" enctype="multipart/form-data" id="roomEditForm">
                @csrf
                @method('patch')
                
                <!-- Room Details Section -->
                <div class="form-section">
                    <h4 class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Room Information
                    </h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="type_id" class="form-label">
                                <i class="fas fa-tag"></i>
                                Room Type
                            </label>
                            <div class="custom-select-wrapper">
                                <select name="type_id" id="type_id" class="form-control @error('type_id') is-invalid @enderror" required autocomplete="type_id" autofocus>
                                    @foreach ($typeRooms as $type)
                                        <option {{ ($type->id == $data->type_id) ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('type_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="number" class="form-label">
                                <i class="fas fa-hashtag"></i>
                                Room Number
                            </label>
                            <input id="number" value="{{ $data->number }}" name="number" type="text" class="form-control @error('number') is-invalid @enderror" required autocomplete="number" oninput="updatePreview()">
                            @error('number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Status Section -->
                <div class="form-section">
                    <h4 class="form-section-title">
                        <i class="fas fa-toggle-on"></i>
                        Room Status
                    </h4>
                    
                    <div class="form-group">
                        <label for="status" class="form-label">
                            <i class="fas fa-circle"></i>
                            Current Status
                        </label>
                        <div class="custom-select-wrapper">
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required autocomplete="status">
                                <option {{ $data->status == "v" ? 'selected' : ''}} value="v">Available</option>
                                <option {{ $data->status == "r" ? 'selected' : ''}} value="r">Reserved</option>
                                <option {{ $data->status == "o" ? 'selected' : ''}} value="o">Occupied</option>
                                <option {{ $data->status == "os" ? 'selected' : ''}} value="os">Out of Service</option>
                            </select>
                        </div>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ url()->previous() }}" class="btn-cancel">
                        <i class="fas fa-arrow-left mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save mr-2"></i>Update Room
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function updatePreview() {
        const numberInput = document.getElementById('number');
        const previewNumber = document.getElementById('preview-number');
        if (numberInput && previewNumber) {
            previewNumber.textContent = numberInput.value;
        }
    }

    // Add real-time validation feedback
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('roomEditForm');
        const inputs = form.querySelectorAll('input, select');
        
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

        // Initialize preview
        updatePreview();
    });
</script>
@endsection
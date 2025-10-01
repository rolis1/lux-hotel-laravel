@extends('layouts.adminlte')
@section('content')

<style>
    /* Custom Room Type Add Styles */
    .add-roomtype-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        overflow: hidden;
        background: #fff;
    }

    .add-roomtype-card .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-bottom: none;
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .add-roomtype-card .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255,255,255,0.1);
        transform: rotate(30deg);
    }

    .add-roomtype-card .card-header h3 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.6rem;
        position: relative;
        z-index: 1;
    }

    .add-roomtype-card .card-header h3 i {
        margin-right: 12px;
        opacity: 0.9;
    }

    .add-roomtype-card .card-body {
        padding: 40px;
        background: #fafbfc;
    }

    .form-container {
        max-width: 900px;
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
        padding: 12px 16px;
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

    /* Facilities Checkbox Grid */
    .facilities-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .facility-checkbox {
        background: #f8f9ff;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .facility-checkbox:hover {
        border-color: #667eea;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
    }

    .facility-checkbox.checked {
        background: linear-gradient(135deg, #f0f4ff 0%, #e8edff 100%);
        border-color: #667eea;
    }

    .form-check-input {
        margin-right: 10px;
        transform: scale(1.2);
    }

    .form-check-label {
        font-weight: 500;
        color: #2c3e50;
        cursor: pointer;
    }

    /* File Upload Styling */
    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 12px 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        text-align: center;
    }

    .file-upload-label:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .file-upload-label i {
        margin-right: 8px;
    }

    .file-upload-input {
        position: absolute;
        left: -9999px;
    }

    .file-name {
        margin-top: 8px;
        font-size: 0.85rem;
        color: #6c757d;
        font-style: italic;
    }

    /* Price Input Styling */
    .price-input-wrapper {
        position: relative;
    }

    .price-input-wrapper::before {
        content: '$';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #667eea;
        font-weight: 600;
        z-index: 2;
    }

    .price-input {
        padding-left: 30px !important;
    }

    /* Textarea Styling */
    .textarea-wrapper {
        position: relative;
    }

    .char-count {
        position: absolute;
        bottom: 10px;
        right: 15px;
        font-size: 0.8rem;
        color: #6c757d;
        background: white;
        padding: 2px 6px;
        border-radius: 4px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #f1f3f4;
    }

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

    /* Preview Section */
    .preview-section {
        background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
        border: 2px dashed #667eea;
        border-radius: 12px;
        padding: 25px;
        margin-top: 20px;
    }

    .preview-title {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 15px;
        font-size: 1.1rem;
        text-align: center;
    }

    .preview-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        text-align: center;
    }

    .preview-item {
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
        font-size: 1rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .add-roomtype-card .card-body {
            padding: 25px 20px;
        }

        .form-section {
            padding: 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .facilities-grid {
            grid-template-columns: 1fr;
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

<div class="card add-roomtype-card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-plus-circle"></i>
            ADD NEW ROOM TYPE
        </h3>
    </div>
    
    <div class="card-body">
        <div class="form-container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form action="{{ route('roomtype.store') }}" method="post" enctype="multipart/form-data" id="roomTypeForm">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="form-section">
                    <h4 class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        Basic Information
                    </h4>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-tag"></i>
                                Room Type Name
                            </label>
                            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="e.g., Deluxe Suite, Standard Room">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">
                                <i class="fas fa-dollar-sign"></i>
                                Price Per Night
                            </label>
                            <div class="price-input-wrapper">
                                <input id="price" name="price" type="number" class="form-control price-input @error('price') is-invalid @enderror" value="{{ old('price') }}" required autocomplete="price" placeholder="0.00" step="0.01" min="0">
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="information" class="form-label">
                            <i class="fas fa-align-left"></i>
                            Description
                        </label>
                        <div class="textarea-wrapper">
                            <textarea name="information" class="form-control @error('information') is-invalid @enderror" id="information" rows="4" required autocomplete="information" autofocus placeholder="Describe the room type, features, and amenities...">{{ old('information') }}</textarea>
                            <div class="char-count" id="charCount">0/500</div>
                        </div>
                        @error('information')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="form-section">
                    <h4 class="form-section-title">
                        <i class="fas fa-concierge-bell"></i>
                        Room Facilities
                    </h4>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-list-check"></i>
                            Select Available Facilities
                        </label>
                        <div class="facilities-grid">
                            @foreach ($roomFacilities as $item)
                                <div class="facility-checkbox" onclick="toggleCheckbox('{{$item->id}}')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $item->facility_name }}" id="{{$item->id}}">
                                        <label class="form-check-label" for="{{ $item->id }}">
                                            {{$item->facility_name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('facilities')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Photo Upload Section -->
                <div class="form-section">
                    <h4 class="form-section-title">
                        <i class="fas fa-camera"></i>
                        Room Photo
                    </h4>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-image"></i>
                            Upload Room Image
                        </label>
                        <div class="file-upload-wrapper">
                            <label for="foto" class="file-upload-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose Room Photo
                            </label>
                            <input id="foto" name="foto" type="file" class="file-upload-input @error('foto') is-invalid @enderror" accept="image/*" required>
                            <div class="file-name" id="fileName">No file chosen</div>
                        </div>
                        @error('foto')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="help-text mt-2">Recommended: JPEG or PNG format, max 2MB</div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="preview-section">
                    <div class="preview-title">
                        <i class="fas fa-eye mr-2"></i>Room Type Preview
                    </div>
                    <div class="preview-content">
                        <div class="preview-item">
                            <div class="preview-label">Room Type</div>
                            <div class="preview-value" id="previewName">-</div>
                        </div>
                        <div class="preview-item">
                            <div class="preview-label">Price</div>
                            <div class="preview-value" id="previewPrice">-</div>
                        </div>
                        <div class="preview-item">
                            <div class="preview-label">Selected Facilities</div>
                            <div class="preview-value" id="previewFacilities">0</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ url()->previous() }}" class="btn-cancel">
                        <i class="fas fa-arrow-left mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save mr-2"></i>Create Room Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleCheckbox(checkboxId) {
        const checkbox = document.getElementById(checkboxId);
        const facilityBox = checkbox.closest('.facility-checkbox');
        
        checkbox.checked = !checkbox.checked;
        
        if (checkbox.checked) {
            facilityBox.classList.add('checked');
        } else {
            facilityBox.classList.remove('checked');
        }
        
        updatePreview();
    }

    function updatePreview() {
        // Update name preview
        const nameInput = document.getElementById('name');
        const previewName = document.getElementById('previewName');
        if (nameInput && previewName) {
            previewName.textContent = nameInput.value || '-';
        }

        // Update price preview
        const priceInput = document.getElementById('price');
        const previewPrice = document.getElementById('previewPrice');
        if (priceInput && previewPrice) {
            previewPrice.textContent = priceInput.value ? '$' + parseFloat(priceInput.value).toFixed(2) : '-';
        }

        // Update facilities count
        const checkedFacilities = document.querySelectorAll('input[name="facilities[]"]:checked');
        const previewFacilities = document.getElementById('previewFacilities');
        if (previewFacilities) {
            previewFacilities.textContent = checkedFacilities.length;
        }
    }

    // Character count for description
    document.getElementById('information')?.addEventListener('input', function(e) {
        const charCount = document.getElementById('charCount');
        if (charCount) {
            charCount.textContent = this.value.length + '/500';
        }
        updatePreview();
    });

    // File name display
    document.getElementById('foto')?.addEventListener('change', function(e) {
        const fileName = document.getElementById('fileName');
        if (fileName) {
            fileName.textContent = this.files[0]?.name || 'No file chosen';
        }
    });

    // Real-time preview updates
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('roomTypeForm');
        const inputs = form.querySelectorAll('input, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
            
            // Real-time validation
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.add('is-valid');
                    this.classList.remove('is-invalid');
                } else {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                }
            });
        });

        // Initialize checkboxes state
        document.querySelectorAll('.facility-checkbox').forEach(box => {
            const checkbox = box.querySelector('input[type="checkbox"]');
            if (checkbox.checked) {
                box.classList.add('checked');
            }
        });

        // Initialize preview
        updatePreview();
    });

    // Price formatting
    document.getElementById('price')?.addEventListener('input', function(e) {
        // Remove any non-numeric characters except decimal point
        this.value = this.value.replace(/[^\d.]/g, '');
        
        // Ensure only one decimal point
        const parts = this.value.split('.');
        if (parts.length > 2) {
            this.value = parts[0] + '.' + parts.slice(1).join('');
        }
    });
</script>
@endsection
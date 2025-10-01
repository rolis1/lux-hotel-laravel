@extends('layouts.template')

@section('content')
<section class="invoice-section section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Invoice Header -->
                <div class="invoice-header text-center mb-5">
                    <div class="invoice-badge">
                        <i class="fas fa-receipt"></i>
                        Payment Invoice
                    </div>
                    <h1 class="invoice-title">Invoice {{ ucfirst($pay->type) }}</h1>
                    <p class="invoice-subtitle">Payment Reference: {{ $pay->nomor }}</p>
                </div>

                <div class="invoice-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- QR Code Section -->
                                <div class="col-md-6 text-center">
                                    <div class="qr-section">
                                        <div class="qr-container">
                                            {!! QrCode::size(200)->generate($pay->url) !!}
                                        </div>
                                        <div class="qr-instructions mt-4">
                                            <h5>How to Pay</h5>
                                            <ul class="list-unstyled">
                                                <li><i class="fas fa-mobile-alt me-2"></i>Open your {{ ucfirst($pay->type) }} app</li>
                                                <li><i class="fas fa-qrcode me-2"></i>Scan this QR code</li>
                                                <li><i class="fas fa-check-circle me-2"></i>Complete the payment</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Details -->
                                <div class="col-md-6">
                                    <div class="payment-details">
                                        <div class="detail-header">
                                            <h4>Payment Details</h4>
                                            <div class="status-badge status-pending">
                                                <i class="fas fa-clock me-1"></i><br>Pending Payment
                                            </div>
                                        </div>

                                        <div class="amount-section">
                                            <div class="amount-label">Total Amount</div>
                                            <div class="amount-value">@currency($totalHarga)</div>
                                        </div>

                                        <div class="payment-info">
                                            <div class="info-item">
                                                <div class="info-label">
                                                    <i class="fas fa-receipt me-2"></i>Invoice Number
                                                </div>
                                                <div class="info-value">{{ $pay->nomor }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">
                                                    <i class="fas fa-wallet me-2"></i>Payment Method
                                                </div>
                                                <div class="info-value">{{ ucfirst($pay->type) }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="info-label">
                                                    <i class="fas fa-calendar me-2"></i>Due Date
                                                </div>
                                                <div class="info-value">{{ \Carbon\Carbon::now()->addHours(24)->format('M d, Y H:i') }}</div>
                                            </div>
                                        </div>

                                        <!-- Important Notice -->
                                        <div class="important-notice">
                                            <div class="notice-header">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                Important
                                            </div>
                                            <p class="notice-text">
                                                Please complete your payment within 24 hours to secure your booking. 
                                                Your reservation will be automatically cancelled if payment is not received.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="action-section mt-5">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="btn-group-custom">
                                            @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'customer.transactions')
                                                <a href="{{ url()->previous() }}" class="btn btn-back">
                                                    <i class="fas fa-arrow-left me-2"></i>Back to Transactions
                                                </a>
                                                <button type="button" class="btn btn-upload" data-bs-toggle="modal" data-bs-target="#uploadProof">
                                                    <i class="fas fa-upload me-2"></i>Upload Payment Proof
                                                </button>
                                            @else
                                                <div class="d-flex flex-wrap gap-3">
                                                    <a href="{{ route('landing') }}" class="btn btn-back">
                                                        <i class="fas fa-home me-2"></i>Back to Home
                                                    </a>
                                                    <a href="{{ route('customer.transactions') }}" class="btn btn-transactions">
                                                        <i class="fas fa-list me-2"></i>View All Transactions
                                                    </a>
                                                    <button type="button" class="btn btn-upload" data-toggle="modal" data-target="#uploadProof">
                                                        <i class="fas fa-upload me-2"></i>Upload Proof
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-md-end">
                                        <div class="share-section">
                                            <button class="btn btn-share" onclick="printInvoice()">
                                                <i class="fas fa-print me-2"></i>Print Invoice
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="help-section mt-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="help-item">
                                        <i class="fas fa-question-circle text-primary"></i>
                                        <div>
                                            <h6>Need Help with Payment?</h6>
                                            <p class="mb-0">Contact our support team for assistance</p>
                                            <a href="tel:+6281212345678" class="help-link">
                                                <i class="fas fa-phone me-1"></i>+62 812-1234-5678
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="help-item">
                                        <i class="fas fa-shield-alt text-success"></i>
                                        <div>
                                            <h6>Secure Payment</h6>
                                            <p class="mb-0">Your payment is protected by SSL encryption</p>
                                            <small class="text-muted">256-bit secure connection</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload Proof Modal -->
    <div class="modal fade" id="uploadProof" tabindex="-1" aria-labelledby="uploadProofLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadProofLabel">
                        <i class="fas fa-cloud-upload-alt me-2"></i>Upload Payment Proof
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('upload.proof') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="payment_id" value="{{ $idPayment }}">
                    <div class="modal-body">
                        <div class="upload-instructions mb-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Please upload a clear screenshot of your successful payment confirmation
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="foto" class="form-label">Payment Proof Image</label>
                            <div class="file-upload-area">
                                <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" 
                                       accept="image/*" required>
                                <div class="file-upload-hint">
                                    <small class="text-muted">Supported formats: JPG, PNG, GIF. Max size: 5MB</small>
                                </div>
                                @error('foto')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="upload-preview mt-3 text-center" id="uploadPreview" style="display: none;">
                            <img id="previewImage" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>Submit Proof
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    function printInvoice() {
        window.print();
    }

    // File upload preview
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewImage');
        const previewContainer = document.getElementById('uploadPreview');
        
        if (file) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    });

    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });
    });
</script>

<style>
.invoice-section {
    padding: 40px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.invoice-header {
    margin-bottom: 40px;
}

.invoice-badge {
    display: inline-block;
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 600;
    margin-bottom: 20px;
    font-size: 1.1rem;
}

.invoice-title {
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 10px;
    font-size: 2.5rem;
}

.invoice-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
}

.invoice-card .card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    overflow: hidden;
}

.invoice-card .card-body {
    padding: 40px;
}

.qr-section {
    padding: 20px;
}

.qr-container {
    background: white;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    display: inline-block;
}

.qr-instructions {
    text-align: left;
}

.qr-instructions h5 {
    color: #1a2a3a;
    margin-bottom: 15px;
    font-weight: 600;
}

.qr-instructions ul li {
    padding: 8px 0;
    color: #6c757d;
    border-bottom: 1px solid #f0f0f0;
}

.qr-instructions ul li:last-child {
    border-bottom: none;
}

.payment-details {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.detail-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.detail-header h4 {
    color: #1a2a3a;
    margin: 0;
    font-weight: 700;
}

.status-badge {
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
}

.status-pending {
    background: rgba(255, 193, 7, 0.15);
    color: #856404;
    border: 1px solid rgba(255, 193, 7, 0.3);
}

.amount-section {
    text-align: center;
    margin-bottom: 30px;
    padding: 30px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
}

.amount-label {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 10px;
}

.amount-value {
    font-size: 2rem;
    font-weight: 700;
    color: #c19a6b;
}

.payment-info {
    margin-bottom: 30px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    color: #6c757d;
    font-weight: 500;
}

.info-value {
    color: #1a2a3a;
    font-weight: 600;
}

.important-notice {
    background: rgba(255, 193, 7, 0.1);
    border: 1px solid rgba(255, 193, 7, 0.3);
    border-radius: 10px;
    padding: 20px;
    margin-top: auto;
}

.notice-header {
    color: #856404;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 1.1rem;
}

.notice-text {
    color: #856404;
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.5;
}

.action-section {
    border-top: 1px solid #f0f0f0;
    padding-top: 30px;
}

.btn-group-custom {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.btn-back, .btn-transactions, .btn-upload, .btn-share {
    padding: 12px 25px;
    margin: 5px;
    border-radius: 10px;
    font-weight: 400;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border: none;
}

.btn-back {
    background: #6c757d;
    color: white;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
    transform: translateY(-2px);
}

.btn-transactions {
    background: #1a2a3a;
    color: white;
}

.btn-transactions:hover {
    background: #0d1b28;
    color: white;
    transform: translateY(-2px);
}

.btn-upload {
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    color: white;
}

.btn-upload:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(193, 154, 107, 0.4);
    color: white;
}

.btn-share {
    background: #17a2b8;
    color: white;
}

.btn-share:hover {
    background: #138496;
    color: white;
    transform: translateY(-2px);
}

.help-section .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.help-section .card-body {
    padding: 30px;
}

.help-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.help-item i {
    font-size: 1.5rem;
    margin-top: 5px;
    flex-shrink: 0;
}

.help-item h6 {
    margin: 0 0 5px 0;
    color: #1a2a3a;
    font-weight: 600;
}

.help-item p {
    margin: 0 0 10px 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.help-link {
    color: #c19a6b;
    text-decoration: none;
    font-weight: 500;
}

.help-link:hover {
    color: #a87c52;
}

/* Modal Styles */
.modal-header {
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    color: white;
    border-bottom: none;
}

.modal-title {
    font-weight: 600;
}

.file-upload-area {
    border: 2px dashed #dee2e6;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

.file-upload-area:hover {
    border-color: #c19a6b;
    background: rgba(193, 154, 107, 0.05);
}

.file-upload-hint {
    margin-top: 10px;
}

.upload-preview img {
    max-width: 100%;
    border-radius: 10px;
}

/* Print Styles */
@media print {
    .invoice-section {
        background: white !important;
        padding: 0 !important;
    }
    
    .btn-group-custom,
    .help-section,
    .modal {
        display: none !important;
    }
    
    .invoice-card .card {
        box-shadow: none !important;
        border: 1px solid #dee2e6 !important;
    }
}

@media (max-width: 768px) {
    .invoice-card .card-body {
        padding: 25px;
    }
    
    .invoice-title {
        font-size: 2rem;
    }
    
    .amount-value {
        font-size: 2rem;
    }
    
    .btn-group-custom {
        flex-direction: column;
    }
    
    .btn-group-custom .btn {
        width: 100%;
        justify-content: center;
    }
    
    .detail-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}
</style>
@endsection
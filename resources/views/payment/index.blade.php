@extends('layouts.template')

@section('content')
<section class="payment-section section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Page Header -->
                <div class="page-header text-center mb-5 mt-30">
                    <h1 class="page-title">Complete Your Payment</h1>
                    <p class="page-subtitle">Review your booking details and choose payment method</p>
                    <div class="progress-bar-container">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="progress-steps">
                            <span class="step completed">Booking Details</span>
                            <span class="step active">Payment</span>
                            <span class="step">Confirmation</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Booking Summary -->
                    <div class="col-lg-8">
                        <div class="booking-summary-card">
                            <div class="card">
                                <div class="card-header">
                                    <h3><i class="fas fa-receipt me-2"></i>Booking Summary</h3>
                                </div>
                                <div class="card-body">
                                    <div class="booking-details">
                                        <div class="detail-row">
                                            <div class="detail-item">
                                                <span class="detail-label">Room Number</span>
                                                <span class="detail-value">{{ $nomorKamar }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Room Type</span>
                                                <span class="detail-value">{{ $dataType->name }}</span>
                                            </div>
                                        </div>
                                        <div class="detail-row">
                                            <div class="detail-item">
                                                <span class="detail-label">Number of Rooms</span>
                                                <span class="detail-value">{{ $jumlahPesanan }}</span>
                                            </div>
                                            <div class="detail-item">
                                                <span class="detail-label">Total Nights</span>
                                                <span class="detail-value">{{ $totalMalam }} nights</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price Breakdown -->
                                    <div class="price-breakdown mt-4">
                                        <h5 class="breakdown-title">Price Breakdown</h5>
                                        <div class="breakdown-item">
                                            <span>@currency($dataType->price) x {{ $totalMalam }} nights x {{ $jumlahPesanan }} room(s)</span>
                                            <span>@currency($dataType->price * $totalMalam * $jumlahPesanan)</span>
                                        </div>
                                        <div class="breakdown-item">
                                            <span>Tax & Service Fee (10%)</span>
                                            <span>@currency($dataType->price * $totalMalam * $jumlahPesanan * 0.1)</span>
                                        </div>
                                        <hr>
                                        <div class="breakdown-total">
                                            <span>Total Amount</span>
                                            <span class="total-amount">@currency($totalHarga)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="info-card mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="info-items">
                                        <div class="info-item">
                                            <i class="fas fa-info-circle text-primary"></i>
                                            <div>
                                                <h6>Important Information</h6>
                                                <p class="mb-0">Your room will be held until 6:00 PM on check-in date. Late check-in may result in cancellation.</p>
                                            </div>
                                        </div>
                                        <div class="info-item">
                                            <i class="fas fa-undo text-warning"></i>
                                            <div>
                                                <h6>Cancellation Policy</h6>
                                                <p class="mb-0">Free cancellation up to 24 hours before check-in. After that, 50% of total amount will be charged.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Section -->
                    <div class="col-lg-4">
                        <div class="payment-card sticky-top">
                            <div class="card">
                                <div class="card-header">
                                    <h3><i class="fas fa-credit-card me-2"></i>Payment Method</h3>
                                </div>
                                <div class="card-body">
                                    <!-- Payment Methods -->
                                    <div class="payment-methods">
                                        <div class="payment-method selected" data-method="dana">
                                            <div class="method-icon">
                                                <i class="fab fa-cc-paypal"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>DANA</h6>
                                                <small>E-Wallet</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>

                                        <div class="payment-method" data-method="ovo">
                                            <div class="method-icon">
                                                <i class="fas fa-mobile-alt"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>OVO</h6>
                                                <small>E-Wallet</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>

                                        <div class="payment-method" data-method="gopay">
                                            <div class="method-icon">
                                                <i class="fas fa-wallet"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>GOPAY</h6>
                                                <small>E-Wallet</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>

                                        <div class="payment-method" data-method="mandiriva">
                                            <div class="method-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>Mandiri VA</h6>
                                                <small>Virtual Account</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>

                                        <div class="payment-method" data-method="briva">
                                            <div class="method-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>BRI VA</h6>
                                                <small>Virtual Account</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>

                                        <div class="payment-method" data-method="bcava">
                                            <div class="method-icon">
                                                <i class="fas fa-university"></i>
                                            </div>
                                            <div class="method-info">
                                                <h6>BCA VA</h6>
                                                <small>Virtual Account</small>
                                            </div>
                                            <div class="method-check">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Payment Form -->
                                    <form action="{{ route('customer.pay.transaction', $transaction->id) }}" method="post" class="payment-form mt-4">
                                        @csrf
                                        <input type="hidden" name="pay_type" id="pay_type" value="dana" required>
                                        
                                        <div class="security-badge mb-3">
                                            <i class="fas fa-lock me-2"></i>
                                            <span>Secure SSL Encrypted Payment</span>
                                        </div>

                                        <button type="submit" class="btn btn-pay-now w-100">
                                            <i class="fas fa-lock me-2"></i>
                                            Pay @currency($totalHarga)
                                        </button>

                                        <div class="text-center mt-3">
                                            <small class="text-muted">
                                                By completing this payment, you agree to our 
                                                <a href="#">Terms of Service</a> and 
                                                <a href="#">Privacy Policy</a>
                                            </small>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment method selection
        const paymentMethods = document.querySelectorAll('.payment-method');
        const payTypeInput = document.getElementById('pay_type');

        paymentMethods.forEach(method => {
            method.addEventListener('click', function() {
                // Remove selected class from all methods
                paymentMethods.forEach(m => m.classList.remove('selected'));
                
                // Add selected class to clicked method
                this.classList.add('selected');
                
                // Update hidden input value
                const selectedMethod = this.getAttribute('data-method');
                payTypeInput.value = selectedMethod;
            });
        });

        // Form submission handling
        const paymentForm = document.querySelector('.payment-form');
        paymentForm.addEventListener('submit', function(e) {
            const payType = payTypeInput.value;
            if (!payType) {
                e.preventDefault();
                alert('Please select a payment method');
                return false;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('.btn-pay-now');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Processing...';
            submitBtn.disabled = true;
            
            // Re-enable button after 3 seconds if still on page (fallback)
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 3000);
        });
    });
</script>

<style>
.payment-section {
    padding: 40px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    min-height: 100vh;
}

.page-header {
    margin-bottom: 40px;
}

.page-title {
    font-weight: 700;
    color: #1a2a3a;
    margin-bottom: 10px;
    font-size: 2.5rem;
}

.page-subtitle {
    color: #6c757d;
    font-size: 1.1rem;
    margin-bottom: 30px;
}

.progress-bar-container {
    max-width: 500px;
    margin: 0 auto;
}

.progress {
    height: 8px;
    background-color: #e9ecef;
    border-radius: 10px;
    margin-bottom: 15px;
}

.progress-bar {
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    border-radius: 10px;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    font-size: 0.85rem;
}

.progress-steps .step {
    color: #6c757d;
    position: relative;
}

.progress-steps .step.completed {
    color: #c19a6b;
    font-weight: 600;
}

.progress-steps .step.active {
    color: #1a2a3a;
    font-weight: 700;
}

.progress-steps .step.completed::after {
    content: '✓';
    margin-left: 5px;
}

.booking-summary-card .card,
.payment-card .card,
.info-card .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    overflow: hidden;
}

.booking-summary-card .card-header,
.payment-card .card-header {
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    color: white;
    border: none;
    padding: 20px 25px;
}

.booking-summary-card .card-header h3,
.payment-card .card-header h3 {
    margin: 0;
    font-size: 1.4rem;
}

.booking-summary-card .card-body {
    padding: 25px;
}

.booking-details {
    margin-bottom: 20px;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    gap: 20px;
}

.detail-item {
    flex: 1;
}

.detail-label {
    display: block;
    font-size: 0.85rem;
    color: #6c757d;
    margin-bottom: 5px;
}

.detail-value {
    display: block;
    font-weight: 600;
    color: #1a2a3a;
    font-size: 1rem;
}

.price-breakdown {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.breakdown-title {
    color: #1a2a3a;
    margin-bottom: 15px;
    font-weight: 600;
}

.breakdown-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    color: #6c757d;
}

.breakdown-total {
    display: flex;
    justify-content: space-between;
    font-size: 1.2rem;
    font-weight: 700;
    color: #1a2a3a;
}

.total-amount {
    color: #c19a6b;
    font-size: 1.4rem;
}

.info-card .card-body {
    padding: 20px;
}

.info-items {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
}

.info-item i {
    font-size: 1.2rem;
    margin-top: 3px;
    flex-shrink: 0;
}

.info-item h6 {
    margin: 0 0 5px 0;
    color: #1a2a3a;
    font-weight: 600;
}

.info-item p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.5;
}

.payment-card {
    top: 20px;
}

.payment-card .card-body {
    padding: 25px;
}

.payment-methods {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.payment-method {
    display: flex;
    align-items: center;
    padding: 15px;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
}

.payment-method:hover {
    border-color: #c19a6b;
    background-color: rgba(193, 154, 107, 0.05);
}

.payment-method.selected {
    border-color: #c19a6b;
    background-color: rgba(193, 154, 107, 0.1);
}

.method-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 15px;
}

.method-info {
    flex: 1;
}

.method-info h6 {
    margin: 0;
    color: #1a2a3a;
    font-weight: 600;
}

.method-info small {
    color: #6c757d;
}

.method-check {
    color: #c19a6b;
    font-size: 1.2rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.payment-method.selected .method-check {
    opacity: 1;
}

.security-badge {
    background: rgba(40, 167, 69, 0.1);
    border: 1px solid rgba(40, 167, 69, 0.3);
    color: #155724;
    padding: 10px 15px;
    border-radius: 8px;
    text-align: center;
    font-size: 0.9rem;
    font-weight: 600;
}

.btn-pay-now {
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    border: none;
    color: white;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-pay-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(193, 154, 107, 0.4);
    color: white;
}

.btn-pay-now:disabled {
    opacity: 0.7;
    transform: none;
    box-shadow: none;
}

@media (max-width: 991px) {
    .payment-card.sticky-top {
        position: relative !important;
        top: 0 !important;
        margin-top: 30px;
    }
    
    .detail-row {
        flex-direction: column;
        gap: 10px;
    }
    
    .page-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .payment-section {
        padding: 20px 0;
    }
    
    .page-title {
        font-size: 1.8rem;
    }
    
    .booking-summary-card .card-body,
    .payment-card .card-body {
        padding: 20px;
    }
}
</style>
@endsection
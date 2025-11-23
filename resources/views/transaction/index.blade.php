<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Transactions - Lux Hotel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #c19a6b;
            --primary-dark: #a87c52;
            --secondary: #1a2a3a;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --white: #ffffff;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
            --info: #17a2b8;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--dark);
        }

        .transaction-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 15px;
        }

        .page-header {
            background: linear-gradient(135deg, var(--secondary) 0%, #2c3e50 100%);
            color: white;
            padding: 30px 0;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
        }

        .page-title {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .transaction-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin-bottom: 20px;
            overflow: hidden;
            transition: var(--transition);
        }

        .transaction-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .transaction-header {
            background: var(--light);
            padding: 15px 20px;
            border-bottom: 1px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .room-type {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--secondary);
        }

        .room-number {
            color: var(--gray);
            font-size: 0.9rem;
        }

        .status-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-process {
            background-color: rgba(255, 193, 7, 0.2);
            color: #856404;
        }

        .status-verified {
            background-color: rgba(40, 167, 69, 0.2);
            color: #155724;
        }

        .status-canceled {
            background-color: rgba(220, 53, 69, 0.2);
            color: #721c24;
        }

        .status-failed {
            background-color: rgba(108, 117, 125, 0.2);
            color: #383d41;
        }

        .status-rejected {
            background-color: rgba(253, 126, 20, 0.2);
            color: #843c0c;
        }

        .status-checked-in {
            background-color: rgba(0, 123, 255, 0.2);
            color: #004085;
        }

        .status-checked-out {
            background-color: rgba(111, 66, 193, 0.2);
            color: #38235c;
        }

        .transaction-body {
            padding: 20px;
        }

        .transaction-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 600;
            color: var(--secondary);
        }

        .price-highlight {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-primary-custom {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary-custom:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-success-custom {
            background-color: var(--success);
            color: white;
        }

        .btn-danger-custom {
            background-color: var(--danger);
            color: white;
        }

        .btn-warning-custom {
            background-color: var(--warning);
            color: var(--dark);
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            background: white;
            border-radius: 10px;
            box-shadow: var(--shadow);
        }

        .empty-icon {
            font-size: 4rem;
            color: var(--light-gray);
            margin-bottom: 20px;
        }

        .empty-title {
            font-size: 1.5rem;
            color: var(--gray);
            margin-bottom: 10px;
        }

        .empty-description {
            color: var(--gray);
            margin-bottom: 30px;
        }

        .pay-all-section {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: var(--shadow);
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .pay-all-info {
            display: flex;
            flex-direction: column;
        }

        .pay-all-label {
            font-size: 0.9rem;
            color: var(--gray);
        }

        .pay-all-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary);
        }

        .modal-header-custom {
            background: var(--secondary);
            color: white;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
        }

        .modal-title-custom {
            font-weight: 600;
        }

        .form-select-custom {
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid var(--light-gray);
            font-size: 1rem;
        }

        .payment-option {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid var(--light-gray);
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-option:hover {
            border-color: var(--primary);
            background-color: rgba(193, 154, 107, 0.05);
        }

        .payment-option.selected {
            border-color: var(--primary);
            background-color: rgba(193, 154, 107, 0.1);
        }

        .payment-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light);
            border-radius: 6px;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .transaction-details {
                grid-template-columns: 1fr;
            }

            .pay-all-section {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="transaction-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="container">
                <h1 class="page-title">My Transactions</h1>
                <p class="page-subtitle">View and manage your booking history</p>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="container">
            @if($datas == '[]')
            <!-- Empty State -->
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-receipt"></i>
                </div>
                <h3 class="empty-title">No Transactions Yet</h3>
                <p class="empty-description">You haven't made any bookings yet. Start exploring our rooms and make your first reservation!</p>
                <a href="{{ route('landing') }}" class="btn btn-primary-custom btn-custom">
                    <i class="fas fa-bed"></i> Browse Rooms
                </a>
            </div>
            @else
            @foreach($datas as $item)
            <div class="transaction-card">
                <div class="transaction-header">
                    <div>
                        <div class="room-type">{{ $item->room->roomType->name }}</div>
                        <div class="room-number">
                            Room
                            @php
                            $roomIds = explode(', ', $item->room_id);
                            $rooms = \App\Models\Room::whereIn('id', $roomIds)->pluck('number')->toArray();
                            echo implode(', ', $rooms);
                            @endphp
                        </div>
                    </div>
                    <div class="status-badge status-{{ str_replace(' ', '-', strtolower($item->status)) }}">
                        {{ $item->status }}
                    </div>
                </div>

                <div class="transaction-body">
                    <div class="transaction-details">
                        <div class="detail-item">
                            <span class="detail-label">Room Type</span>
                            <span class="detail-value">{{ $item->room->roomType->name }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Room Number</span>
                            <span class="detail-value">
                                @php
                                $roomIds = explode(', ', $item->room_id);
                                $roomNumbers = \App\Models\Room::whereIn('id', $roomIds)->pluck('number')->toArray();
                                echo implode(', ', $roomNumbers);
                                @endphp
                            </span>

                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Number of Rooms</span>
                            <span class="detail-value">{{ $item->many_room }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Price per Night</span>
                            <span class="detail-value price-highlight">@currency($item->room->roomType->price)</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Total Price</span>
                            <span class="detail-value price-highlight">@currency($item->payment->price)</span>
                        </div>
                    </div>

                    <div class="action-buttons">
                        @if ($item->status == 'canceled')
                        <span class="btn btn-danger-custom btn-custom disabled">
                            <i class="fas fa-times-circle"></i> Transaction Canceled
                        </span>
                        @elseif ($item->status == 'process')
                        <span class="btn btn-warning-custom btn-custom disabled">
                            <i class="fas fa-clock"></i> Transaction on Process
                        </span>
                        @elseif ($item->status == 'verified')
                        <a href="{{ route('transaction.proof', $item->id) }}" class="btn btn-success-custom btn-custom">
                            <i class="fas fa-print"></i> Print Proof
                        </a>
                        @elseif ($item->status == 'failed')
                        <span class="btn btn-danger-custom btn-custom disabled">
                            <i class="fas fa-exclamation-triangle"></i> Transaction Failed
                        </span>
                        @elseif ($item->status == 'rejected')
                        <div class="d-flex flex-column w-100">
                            <div class="alert alert-warning mb-2">
                                <i class="fas fa-exclamation-circle"></i> Your proof has been rejected by Receptionist, please upload your proof again!
                            </div>
                            <button type="button" class="btn btn-primary-custom btn-custom" data-bs-toggle="modal" data-bs-target="#uploadProof{{ $item->id }}">
                                <i class="fas fa-upload"></i> Upload Proof
                            </button>
                        </div>
                        @elseif($item->status == 'checked in')
                        <span class="btn btn-info btn-custom disabled">
                            <i class="fas fa-sign-in-alt"></i> Checked In on {{ $item->updated_at->format('M d, Y') }}
                        </span>
                        @elseif($item->status == 'checked out')
                        <span class="btn btn-secondary btn-custom disabled">
                            <i class="fas fa-sign-out-alt"></i> Checked Out on {{ $item->updated_at->format('M d, Y') }}
                        </span>
                        @else
                        <div class="action-buttons">
                            <a href="{{ route('customer.cancel.transaction', $item->id) }}" onclick="return confirm('Are you sure you want to cancel this transaction?')" class="btn btn-danger-custom btn-custom">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="button" class="btn btn-primary-custom btn-custom" data-bs-toggle="modal" data-bs-target="#payType{{ $item->id }}">
                                <i class="fas fa-credit-card"></i> Pay Now
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Upload Proof Modal -->
            @if($item->status == 'rejected')
            <div class="modal fade" id="uploadProof{{ $item->id }}" tabindex="-1" aria-labelledby="uploadProofLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title modal-title-custom" id="uploadProofLabel">Upload Payment Proof</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('upload.proof') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="payment_id" value="{{ $item->id }}">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Proof Image</label>
                                    <input id="foto" name="foto" type="file" class="form-control @error('foto') is-invalid @enderror" required>
                                    <div class="form-text">Please upload a clear image of your payment proof.</div>
                                    @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary-custom">Upload Proof</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Payment Type Modal -->
            @if($item->status != 'canceled' && $item->status != 'process' && $item->status != 'verified' &&
            $item->status != 'failed' && $item->status != 'rejected' && $item->status != 'checked in' &&
            $item->status != 'checked out')
            <div class="modal fade" id="payType{{ $item->id }}" tabindex="-1" aria-labelledby="payTypeLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header modal-header-custom">
                            <h5 class="modal-title modal-title-custom" id="payTypeLabel">Select Payment Method</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('customer.pay.transaction', $item->id) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Choose your payment method:</label>

                                    <div class="payment-option" onclick="selectPayment(this, 'dana')">
                                        <div class="payment-icon text-primary">
                                            <i class="fab fa-cc-paypal"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">DANA</div>
                                            <small class="text-muted">Pay with DANA e-wallet</small>
                                        </div>
                                    </div>

                                    <div class="payment-option" onclick="selectPayment(this, 'ovo')">
                                        <div class="payment-icon text-success">
                                            <i class="fas fa-mobile-alt"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">OVO</div>
                                            <small class="text-muted">Pay with OVO e-wallet</small>
                                        </div>
                                    </div>

                                    <div class="payment-option" onclick="selectPayment(this, 'gopay')">
                                        <div class="payment-icon text-info">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">GOPAY</div>
                                            <small class="text-muted">Pay with GoPay e-wallet</small>
                                        </div>
                                    </div>

                                    <div class="payment-option" onclick="selectPayment(this, 'mandiriva')">
                                        <div class="payment-icon" style="color: #ff6b00;">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">Mandiri VA</div>
                                            <small class="text-muted">Pay with Mandiri Virtual Account</small>
                                        </div>
                                    </div>

                                    <div class="payment-option" onclick="selectPayment(this, 'briva')">
                                        <div class="payment-icon text-danger">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">BRI VA</div>
                                            <small class="text-muted">Pay with BRI Virtual Account</small>
                                        </div>
                                    </div>

                                    <div class="payment-option" onclick="selectPayment(this, 'bcava')">
                                        <div class="payment-icon text-primary">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">BCA VA</div>
                                            <small class="text-muted">Pay with BCA Virtual Account</small>
                                        </div>
                                    </div>

                                    <input type="hidden" name="pay_type" id="pay_type_input{{ $item->id }}" value="" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary-custom">Proceed to Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
            @endif

            <!-- Back to Home Button -->
            <div class="mt-4">
                <a href="{{ route('landing') }}" class="btn btn-warning-custom btn-custom">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Pay All Modal -->
    @if($pay != '0')
    <div class="modal fade" id="payAllType" tabindex="-1" aria-labelledby="payAllTypeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title modal-title-custom" id="payAllTypeLabel">Pay All Transactions</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('customer.invoice') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select payment method for all transactions:</label>
                            <select name="pay_type" id="pay_type" class="form-select form-select-custom" required>
                                <option value="">Choose a payment method</option>
                                <option value="dana">DANA</option>
                                <option value="ovo">OVO</option>
                                <option value="gopay">GOPAY</option>
                                <option value="mandiriva">Mandiri VA</option>
                                <option value="briva">BRI VA</option>
                                <option value="bcava">BCA VA</option>
                            </select>
                        </div>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> You are about to pay for all your pending transactions with a total amount of <strong>@currency($pay)</strong>.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary-custom">Confirm Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectPayment(element, paymentType) {
            // Remove selected class from all payment options
            document.querySelectorAll('.payment-option').forEach(opt => {
                opt.classList.remove('selected');
            });

            // Add selected class to clicked option
            element.classList.add('selected');

            // Set the value in the hidden input
            const modalId = element.closest('.modal').id;
            const itemId = modalId.replace('payType', '');
            document.getElementById('pay_type_input' + itemId).value = paymentType;
        }

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>

</html>
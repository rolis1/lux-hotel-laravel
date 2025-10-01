@extends('layouts.template')
@section('content')
<section class="room-detail-section section_gap">
    <div class="container">
        <div class="row">
            <!-- Room Images Section -->
            <div class="col-lg-7">
                <div class="room-image-container">
                    <div class="main-image">
                        <img src="{{asset('images/kamar/' . $data->foto)}}" class="img-fluid" alt="{{ $data->name }}">
                    </div>
                    <!-- Additional images placeholder - you can add more if available -->
                    <div class="image-thumbnails mt-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{asset('images/kamar/' . $data->foto)}}" class="img-thumbnail active" alt="Room view 1">
                            </div>
                            <!-- Add more thumbnails if you have multiple images -->
                        </div>
                    </div>
                </div>
                
                <!-- Room Information Section -->
                <div class="room-info-card mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-info-circle me-2"></i>Room Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="room-features">
                                <div class="feature-item">
                                    <i class="fas fa-bed feature-icon"></i>
                                    <div class="feature-content">
                                        <h5>Room Type</h5>
                                        <p>{{ $data->name }}</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-tv feature-icon"></i>
                                    <div class="feature-content">
                                        <h5>Room Facilities</h5>
                                        <p>{{ $data->facilities }}</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-user-friends feature-icon"></i>
                                    <div class="feature-content">
                                        <h5>Bed Capacity</h5>
                                        <p>2 Persons</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-expand-arrows-alt feature-icon"></i>
                                    <div class="feature-content">
                                        <h5>Room Size</h5>
                                        <p>35 m²</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="room-description mt-4">
                                <h5>Room Description</h5>
                                <p class="description-text">{{ $data->information }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Booking Section -->
            <div class="col-lg-5">
                <div class="booking-card sticky-top">
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-calendar-check me-2"></i>Book This Room</h3>
                        </div>
                        <div class="card-body">
                            <!-- Price & Availability -->
                            <div class="price-section text-center mb-4">
                                <div class="price-display">
                                    <span class="price-amount">@currency($data->price)</span>
                                    <span class="price-period">/ night</span>
                                </div>
                                <div class="availability-badge {{ $jumlahTersedia > 0 ? 'available' : 'sold-out' }}">
                                    <i class="fas {{ $jumlahTersedia > 0 ? 'fa-check-circle' : 'fa-times-circle' }} me-1"></i>
                                    {{ $jumlahTersedia > 0 ? $jumlahTersedia . ' Rooms Available' : 'Sold Out' }}
                                </div>
                            </div>
                            
                            @auth
                                @if ($jumlahTersedia == 0)
                                    <div class="alert alert-warning text-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        This room type is currently fully booked
                                    </div>
                                @else
                                    <form action="{{ route('customer.book.now') }}" method="post" class="booking-form">
                                        @csrf
                                        <input type="hidden" name="type_id" value="{{ $data->id }}">
                                        <input type="hidden" name="stok" value="{{ $jumlahTersedia }}">
                                        
                                        <div class="form-group mb-3">
                                            <label for="jumlah" class="form-label">
                                                <i class="fas fa-door-open me-2"></i>Number of Rooms
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                                <input type="number" class="form-control" 
                                                       value="1" min="1" max="{{ $jumlahTersedia }}" 
                                                       required name="jumlah" id="jumlah">
                                                <span class="input-group-text">Max: {{ $jumlahTersedia }}</span>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label for="check_in" class="form-label">
                                                <i class="fas fa-sign-in-alt me-2"></i>Check-in Date
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                <input type="date" class="form-control" 
                                                       min='<?= date('Y-m-d'); ?>' 
                                                       value="{{old('check_in')}}" 
                                                       onchange="checkout()" 
                                                       required name="check_in" id="check_in">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-4">
                                            <label for="check_out" class="form-label">
                                                <i class="fas fa-sign-out-alt me-2"></i>Check-out Date
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                <input type="date" class="form-control" 
                                                       disabled min='<?= date('Y-m-d', strtotime('+1 day')); ?>' 
                                                       value="{{old('check_out')}}" 
                                                       required name="check_out" id="check_out">
                                            </div>
                                        </div>
                                        
                                        <!-- Price Summary -->
                                        <div class="price-summary mb-4">
                                            <div class="summary-item d-flex justify-content-between">
                                                <span>@currency($data->price) x <span id="nights-count">1</span> night</span>
                                                <span id="subtotal">@currency($data->price)</span>
                                            </div>
                                            <div class="summary-item d-flex justify-content-between">
                                                <span>Tax & Service</span>
                                                <span>@currency(0.1 * $data->price)</span>
                                            </div>
                                            <hr>
                                            <div class="summary-total d-flex justify-content-between">
                                                <strong>Total</strong>
                                                <strong id="total-price">@currency($data->price * 1.1)</strong>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-book-now w-100">
                                            <i class="fas fa-lock me-2"></i>Book Now
                                        </button>
                                    </form>
                                @endif
                            @else
                                <div class="login-required text-center">
                                    <div class="alert alert-info mb-4">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Please login to book this room
                                    </div>
                                    <a href="{{ route('login') }}" class="btn btn-login w-100">
                                        <i class="fas fa-sign-in-alt me-2"></i>Login to Continue
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Rooms Section -->
<section class="similar-rooms-section section_gap bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2>You Might Also Like</h2>
            <p class="text-muted">Explore other room types in our hotel</p>
        </div>
        <!-- Add similar rooms carousel or grid here -->
    </div>
</section>
@endsection

@section('script')
<script>
    function checkout(){
        var checkin = new Date($('#check_in').val());
        var dd = checkin.getDate()+1;
        var mm = checkin.getMonth()+1;
        var yyyy = checkin.getFullYear();
        var lastDayOfMonth = new Date(yyyy, mm, 0);
        
        if(dd<10){
            dd='0'+dd
        }
        if(dd > lastDayOfMonth.getDate()){
            dd='01'
            mm+=1
        }
        if(mm<10){
            mm='0'+mm
        }

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById("check_out").setAttribute("min", today);
        document.getElementById("check_out").removeAttribute("disabled");
        
        // Update price calculation
        updatePrice();
    }
    
    function updatePrice() {
        const checkIn = new Date($('#check_in').val());
        const checkOut = new Date($('#check_out').val());
        const roomCount = parseInt($('#jumlah').val());
        const pricePerNight = {{ $data->price }};
        
        if (checkIn && checkOut && !isNaN(checkIn.getTime()) && !isNaN(checkOut.getTime())) {
            const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
            if (nights > 0) {
                const subtotal = pricePerNight * nights * roomCount;
                const tax = subtotal * 0.1;
                const total = subtotal + tax;
                
                $('#nights-count').text(nights);
                $('#subtotal').text(formatCurrency(subtotal));
                $('#total-price').text(formatCurrency(total));
            }
        }
    }
    
    function formatCurrency(amount) {
        return 'IDR ' + amount.toLocaleString('id-ID');
    }
    
    // Initialize price calculation
    $(document).ready(function() {
        $('#jumlah, #check_in, #check_out').on('change input', updatePrice);
        updatePrice();
        
        // Image thumbnail click handler
        $('.image-thumbnails .img-thumbnail').click(function() {
            $('.image-thumbnails .img-thumbnail').removeClass('active');
            $(this).addClass('active');
            $('.main-image img').attr('src', $(this).attr('src'));
        });
    });
</script>

<style>
.room-detail-section {
    padding: 40px 0;
}

.room-image-container {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.main-image img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 15px;
}

.image-thumbnails .img-thumbnail {
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.image-thumbnails .img-thumbnail.active,
.image-thumbnails .img-thumbnail:hover {
    border-color: #c19a6b;
    transform: scale(1.05);
}

.room-info-card .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
}

.room-info-card .card-header {
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 20px;
    margin-top: 20px;
}

.room-info-card .card-header h3 {
    margin: 0;
    font-size: 1.5rem;
}

.room-features .feature-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #f0f0f0;
}

.room-features .feature-item:last-child {
    border-bottom: none;
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    color: white;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-right: 15px;
    flex-shrink: 0;
}

.feature-content h5 {
    margin: 0 0 5px 0;
    color: #1a2a3a;
    font-size: 1rem;
}

.feature-content p {
    margin: 0;
    color: #6c757d;
}

.room-description h5 {
    color: #1a2a3a;
    margin-bottom: 10px;
}

.description-text {
    line-height: 1.8;
    color: #6c757d;
}

.booking-card {
    top: 80px;
}

.booking-card .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.booking-card .card-header {
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
    border: none;
    padding: 20px;
}

.booking-card .card-header h3 {
    margin: 0;
    font-size: 1.5rem;
}

.price-section {
    padding: 20px 0;
    border-bottom: 1px solid #f0f0f0;
}

.price-display {
    margin-bottom: 15px;
}

.price-amount {
    font-size: 2.5rem;
    font-weight: 700;
    color: #c19a6b;
}

.price-period {
    font-size: 1rem;
    color: #6c757d;
}

.availability-badge {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.availability-badge.available {
    background: rgba(40, 167, 69, 0.15);
    color: #155724;
    border: 1px solid rgba(40, 167, 69, 0.3);
}

.availability-badge.sold-out {
    background: rgba(220, 53, 69, 0.15);
    color: #721c24;
    border: 1px solid rgba(220, 53, 69, 0.3);
}

.booking-form .form-label {
    font-weight: 600;
    color: #1a2a3a;
    margin-bottom: 8px;
}

.booking-form .input-group-text {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
}

.price-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
}

.summary-item {
    margin-bottom: 10px;
    color: #6c757d;
}

.summary-total {
    font-size: 1.2rem;
    color: #1a2a3a;
}

.btn-book-now {
    background: linear-gradient(135deg, #c19a6b 0%, #a87c52 100%);
    border: none;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.btn-book-now:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(193, 154, 107, 0.4);
}

.btn-login {
    background: linear-gradient(135deg, #1a2a3a 0%, #2c3e50 100%);
    border: none;
    padding: 15px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 10px;
    color: white;
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(26, 42, 58, 0.4);
    color: white;
}

.similar-rooms-section {
    padding: 60px 0;
}

.section-header h2 {
    color: #1a2a3a;
    font-weight: 700;
    margin-bottom: 10px;
}

@media (max-width: 991px) {
    .booking-card.sticky-top {
        position: relative !important;
        top: 0 !important;
    }
    
    .room-image-container {
        margin-bottom: 30px;
    }
}
</style>
@endsection
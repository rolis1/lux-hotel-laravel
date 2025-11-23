@extends('layouts.template')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lux Hotel - Luxury Accommodations</title>
    <style>
        /* Base Styles */
        :root {
            --primary: #c19a6b;
            --primary-dark: #a87c52;
            --secondary: #1a2a3a;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6c757d;
            --light-gray: #e9ecef;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            line-height: 1.6;
            color: var(--dark);
            overflow-x: hidden;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        img {
            max-width: 100%;
            height: auto;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        
        .section_gap {
            padding: 80px 0;
        }
        
        .section_title {
            margin-bottom: 50px;
        }
        
        .title_color {
            color: var(--secondary);
        }
        
        .title_w {
            color: var(--white);
        }
        
        .sec_h4 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .mb_30 {
            margin-bottom: 30px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .d_flex {
            display: flex;
        }
        
        .align-items-center {
            align-items: center;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            cursor: pointer;
            border: none;
        }
        
        .theme_btn {
            background-color: var(--primary);
            color: var(--white);
        }
        
        .theme_btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: var(--shadow);
        }
        
        .button_hover:hover {
            color: var(--white);
        }
        
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        
        .col-md-6, .col-md-12, .col-lg-4, .col-sm-6 {
            padding: 0 15px;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .col-lg-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
        
        .col-sm-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
        
        /* Banner Area */
        .banner_area {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            background: linear-gradient(rgba(26, 42, 58, 0.7), rgba(26, 42, 58, 0.7)), url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            color: var(--white);
        }
        
        .banner_content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .banner_content h6 {
            font-size: 18px;
            font-weight: 400;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }
        
        .banner_content h2 {
            font-size: 60px;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
        }
        
        .banner_content p {
            font-size: 18px;
            margin-bottom: 30px;
        }
        
        .hotel_booking_area {
            position: absolute;
            bottom: -60px;
            left: 0;
            right: 0;
            z-index: 10;
        }
        
        .hotel_booking_table {
            background: var(--white);
            border-radius: 8px;
            padding: 30px;
            box-shadow: var(--shadow);
        }
        
        .hotel_booking_table h2 {
            color: var(--secondary);
            font-size: 24px;
            font-weight: 600;
        }
        
        /* Accomodation Area */
        .accomodation_area {
            background-color: var(--light);
        }
        
        .accomodation_item {
            background: var(--white);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            margin-bottom: 30px;
        }
        
        .accomodation_item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .hotel_img {
            position: relative;
            overflow: hidden;
        }
        
        .hotel_img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: var(--transition);
        }
        
        .accomodation_item:hover .hotel_img img {
            transform: scale(1.05);
        }
        
        .hotel_img .btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: var(--transition);
        }
        
        .accomodation_item:hover .hotel_img .btn {
            opacity: 1;
        }
        
        .accomodation_item > a {
            display: block;
            padding: 20px;
        }
        
        .accomodation_item h5 {
            color: var(--primary);
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .accomodation_item p {
            color: var(--gray);
        }
        
        /* Facilities Area */
        .facilities_area {
            position: relative;
            background: linear-gradient(rgba(26, 42, 58, 0.85), rgba(26, 42, 58, 0.85)), url('https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover;
            color: var(--white);
        }
        
        .facilities_item {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 30px;
            transition: var(--transition);
            height: 100%;
        }
        
        .facilities_item:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.15);
        }
        
        .facilities_item i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        /* About History Area */
        .about_content {
            padding-right: 30px;
        }
        
        .about_content h2 {
            margin-bottom: 20px;
            font-size: 36px;
            font-weight: 700;
        }
        
        .about_content p {
            margin-bottom: 20px;
            line-height: 1.8;
        }
        
        .about_content img {
            border-radius: 8px;
            box-shadow: var(--shadow);
        }
        
        /* Responsive */
        @media (max-width: 991px) {
            .col-lg-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
            
            .banner_content h2 {
                font-size: 48px;
            }
        }
        
        @media (max-width: 767px) {
            .col-md-6, .col-sm-6, .col-lg-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
            
            .banner_content h2 {
                font-size: 36px;
            }
            
            .hotel_booking_area {
                position: relative;
                bottom: 0;
                margin-top: 30px;
            }
            
            .about_content {
                padding-right: 0;
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>
    <!--================Banner Area =================-->
        <section class="banner_area" id="home">
            <div class="booking_table d_flex align-items-center">
            	<div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
				<div class="container">
					<div class="banner_content text-center">
						<h6>Away from monotonous life</h6>
						<h2>Lux Hotel</h2>
						<p>Penginapan bersih, aman, nyaman, sehat<br> Harga yang terjangkau anda dapat menginap disini</p>
						<a href="#types" class="btn theme_btn button_hover">Book Sekarang</a>
					</div>
				</div>
            </div>
            <div class="hotel_booking_area position">
                <div class="container">
                    <div class="hotel_booking_table">
                        <div class="col-md-12">
                            <center>
                            <h2>Kami tidak pernah meragukan tamu<br> Meski permintaannya aneh-aneh</h2>
                            </center>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    <!--================Banner Area =================-->

    <!--================ Accomodation Area  =================-->
        <section class="accomodation_area section_gap" id="types">
            <div class="container">
                <div class="section_title text-center">
                    <h2 class="title_color">Hotel Types</h2>
                </div>
                <div class="row mb_30">
                    @foreach ($roomTypes as $item)
                        <div class="col-lg-4 col-sm-6">
                            <div class="accomodation_item text-center">
                                <div class="hotel_img">
                                    <a href="{{ route('detail.room', $item->id) }}">
                                        <img src="{{ asset('images/tipekamar/'.$item->foto) }}" width="250px" alt="">
                                    </a>
                                    <a href="{{ route('detail.room', $item->id) }}" class="btn theme_btn button_hover">Book Now</a>
                                </div>
                                <a href="{{ route('detail.room', $item->id) }}"><h4 class="sec_h4">{{ $item->name }}</h4></a>
                                <a href="{{ route('detail.room', $item->id) }}">
                                    <h5>@currency($item->price)<small>/night</small></h5>
                                </a>
                                <p>Kamar Tersedia : {{ $item->getTotalRooms->count() }}</p>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!--================ Accomodation Area  =================-->

    <!--================ Facilities Area  =================-->
    <section class="facilities_area section_gap" id="facilities">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_w">Hotel Facilities</h2>
                <p>Fasilitas terbaik untuk mengakomodir kebutuhan anda!</p>
            </div>
            <div class="row mb_30">
                    @foreach ($hotelFacilities as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="facilities_item">
                            <h4 class="sec_h4"><i class="lnr lnr-star-empty"></i>{{ $item->facility_name }}</h4>
                            <p>{{ $item->detail }}</p>
                        </div>
                    </div>
                    @endforeach


                </div>
        </div>
    </section>
    <!--================ Facilities Area  =================-->

    <!--================ About History Area  =================-->
    <section class="about_history_area section_gap" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d_flex align-items-center">
                    <div class="about_content ">
                        <h2 class="title title_color">About Us</h2>
                        <p>
                            Didirikan pada tahun 1986 oleh <b>Lux Group</b>, Lux Hotel
                            hadir sebagai tempat penginapan yang memadukan kenyamanan
                            modern dengan sentuhan tropis dan nuansa tradisional
                            khas Indonesia. Dengan pengalaman lebih dari tiga dekade
                            di industri perhotelan, Lux Hotel terus berkomitmen untuk
                            memberikan pelayanan terbaik bagi setiap tamu yang datang,
                            baik untuk urusan bisnis maupun liburan.
                            <br>
                            <br>
                            Kami percaya bahwa kenyamanan bukan hanya tentang tempat,
                            tetapi juga tentang pelayanan dan suasana. Oleh karena itu,
                            Lux Hotel selalu berinovasi untuk menjawab kebutuhan
                            tamu dengan layanan yang profesional dan fasilitas yang
                            terus diperbaharui.
                        </p>
                        <a href="#" class="btn theme_btn button_hover" style="margin-top: 20px;">Learn More</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-fluid" src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Lux Hotel">
                </div>
            </div>
        </div>
    </section>
    <!--================ About History Area  =================-->
</body>
</html>
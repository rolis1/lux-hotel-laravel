<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Lux Hotel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Custom Styles -->
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
      --shadow: 0 5px 15px rgba(0,0,0,0.1);
      --transition: all 0.3s ease;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Source Sans Pro', sans-serif;
    }
    
    body {
      background: linear-gradient(rgba(26, 42, 58, 0.85), rgba(26, 42, 58, 0.85)), 
                  url('https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--dark);
    }
    
    .login-container {
      display: flex;
      width: 900px;
      max-width: 90%;
      height: 550px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }
    
    .login-left {
      flex: 1;
      background: var(--white);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .login-right {
      flex: 1;
      background: linear-gradient(rgba(193, 154, 107, 0.9), rgba(168, 124, 82, 0.9)), 
                  url('https://images.unsplash.com/photo-1584132967334-10e028bd69f7?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80') no-repeat center center;
      background-size: cover;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      color: var(--white);
      text-align: center;
    }
    
    .hotel-logo {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .hotel-logo h1 {
      font-size: 36px;
      font-weight: 700;
      color: var(--secondary);
    }
    
    .hotel-logo span {
      color: var(--primary);
    }
    
    .login-header {
      margin-bottom: 30px;
    }
    
    .login-header h2 {
      font-size: 28px;
      font-weight: 600;
      color: var(--secondary);
      margin-bottom: 10px;
    }
    
    .login-header p {
      color: var(--gray);
    }
    
    .form-group {
      margin-bottom: 20px;
      position: relative;
    }
    
    .form-control {
      width: 100%;
      padding: 15px 15px 15px 45px;
      border: 1px solid var(--light-gray);
      border-radius: 6px;
      font-size: 16px;
      transition: var(--transition);
      background-color: var(--light);
    }
    
    .form-control:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(193, 154, 107, 0.2);
    }
    
    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray);
    }
    
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    
    .remember-me {
      display: flex;
      align-items: center;
    }
    
    .remember-me input {
      margin-right: 8px;
    }
    
    .forgot-password {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }
    
    .forgot-password:hover {
      text-decoration: underline;
    }
    
    .btn-login {
      width: 100%;
      padding: 15px;
      background: var(--primary);
      color: var(--white);
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
      margin-bottom: 20px;
    }
    
    .btn-login:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }
    
    .register-link {
      text-align: center;
      color: var(--gray);
    }
    
    .register-link a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }
    
    .register-link a:hover {
      text-decoration: underline;
    }
    
    .welcome-text {
      margin-bottom: 30px;
    }
    
    .welcome-text h2 {
      font-size: 32px;
      margin-bottom: 15px;
      font-weight: 700;
    }
    
    .welcome-text p {
      font-size: 18px;
      line-height: 1.6;
    }
    
    .hotel-features {
      list-style: none;
      margin-top: 30px;
    }
    
    .hotel-features li {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
    }
    
    .hotel-features i {
      margin-right: 10px;
      color: var(--white);
      font-size: 18px;
    }
    
    .error-message {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 5px;
      display: block;
    }
    
    .input-error {
      border-color: #e74c3c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        height: auto;
        max-width: 95%;
      }
      
      .login-right {
        display: none;
      }
      
      .login-left {
        padding: 30px 25px;
      }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-left">
      <div class="hotel-logo">
        <h1>LUX <span>HOTEL</span></h1>
      </div>
      
      <div class="login-header">
        <h2>Welcome Back</h2>
        <p>Sign in to your account to continue</p>
      </div>
      
      <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" placeholder="Email Address" class="form-control @error('email') input-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" placeholder="Password" class="form-control @error('password') input-error @enderror" name="password" required autocomplete="current-password">
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-options">
          <div class="remember-me">
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label for="remember">Remember Me</label>
          </div>
          <a href="#" class="forgot-password">Forgot Password?</a>
        </div>

        <button type="submit" class="btn-login">Sign In</button>

        <div class="register-link">
          Don't have an account? <a href="{{ route('register') }}">Register Now</a>
        </div>
      </form>
    </div>
    
    <div class="login-right">
      <div class="welcome-text">
        <h2>Experience Luxury</h2>
        <p>Discover our world-class accommodations and exceptional service at Lux Hotel</p>
      </div>
      
      <ul class="hotel-features">
        <li><i class="fas fa-check-circle"></i> Premium Room Service</li>
        <li><i class="fas fa-check-circle"></i> World-Class Amenities</li>
        <li><i class="fas fa-check-circle"></i> 24/7 Customer Support</li>
        <li><i class="fas fa-check-circle"></i> Best Price Guarantee</li>
      </ul>
    </div>
  </div>

  <script>
    // Add focus effects to form inputs
    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.querySelector('.input-icon').style.color = '#c19a6b';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.querySelector('.input-icon').style.color = '#6c757d';
      });
    });
  </script>
</body>
</html>
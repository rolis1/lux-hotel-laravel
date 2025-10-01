<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Lux Hotel</title>

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
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      color: var(--dark);
    }
    
    .register-container {
      display: flex;
      width: 1000px;
      max-width: 95%;
      min-height: 650px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }
    
    .register-left {
      flex: 1.2;
      background: var(--white);
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .register-right {
      flex: 0.8;
      background: linear-gradient(rgba(193, 154, 107, 0.9), rgba(168, 124, 82, 0.9)), 
                  url('https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-1.2.1&auto=format&fit=crop&w=700&q=80') no-repeat center center;
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
    
    .register-header {
      margin-bottom: 30px;
    }
    
    .register-header h2 {
      font-size: 28px;
      font-weight: 600;
      color: var(--secondary);
      margin-bottom: 10px;
    }
    
    .register-header p {
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
    
    .form-row {
      display: flex;
      gap: 15px;
    }
    
    .form-row .form-group {
      flex: 1;
    }
    
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
    }
    
    .terms-agreement {
      display: flex;
      align-items: flex-start;
    }
    
    .terms-agreement input {
      margin-right: 8px;
      margin-top: 3px;
    }
    
    .terms-agreement label {
      font-size: 14px;
      line-height: 1.4;
    }
    
    .terms-link {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }
    
    .terms-link:hover {
      text-decoration: underline;
    }
    
    .btn-register {
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
    
    .btn-register:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: var(--shadow);
    }
    
    .login-link {
      text-align: center;
      color: var(--gray);
    }
    
    .login-link a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }
    
    .login-link a:hover {
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
    
    .member-benefits {
      list-style: none;
      margin-top: 30px;
      text-align: left;
    }
    
    .member-benefits li {
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      font-size: 16px;
    }
    
    .member-benefits i {
      margin-right: 10px;
      color: var(--white);
      font-size: 18px;
      background: rgba(255,255,255,0.2);
      width: 30px;
      height: 30px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
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
    
    .password-strength {
      margin-top: 5px;
      font-size: 14px;
    }
    
    .strength-weak {
      color: #e74c3c;
    }
    
    .strength-medium {
      color: #f39c12;
    }
    
    .strength-strong {
      color: #27ae60;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
      .register-container {
        flex-direction: column;
        max-width: 600px;
      }
      
      .register-right {
        display: none;
      }
    }
    
    @media (max-width: 576px) {
      .register-left {
        padding: 30px 20px;
      }
      
      .form-row {
        flex-direction: column;
        gap: 0;
      }
      
      .hotel-logo h1 {
        font-size: 32px;
      }
      
      .register-header h2 {
        font-size: 24px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <div class="register-left">
      <div class="hotel-logo">
        <h1>LUX <span>HOTEL</span></h1>
      </div>
      
      <div class="register-header">
        <h2>Create Your Account</h2>
        <p>Join Lux Hotel to enjoy exclusive benefits and offers</p>
      </div>
      
      <form action="{{ route('register') }}" method="post">
        @csrf
        
        <div class="form-group">
          <i class="fas fa-user input-icon"></i>
          <input type="text" placeholder="Full Name" class="form-control @error('name') input-error @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          @error('name')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" placeholder="Email Address" class="form-control @error('email') input-error @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
          @error('email')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <i class="fas fa-phone input-icon"></i>
          <input type="text" placeholder="Phone Number" class="form-control @error('phone') input-error @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
          @error('phone')
            <span class="error-message">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" class="form-control @error('password') input-error @enderror" placeholder="Password" name="password" required autocomplete="new-password" id="password">
          @error('password')
            <span class="error-message">{{ $message }}</span>
          @enderror
          <div class="password-strength" id="password-strength"></div>
        </div>

        <div class="form-group">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" id="confirm-password">
          <div class="password-strength" id="password-match"></div>
        </div>

        <div class="form-options">
          <div class="terms-agreement">
            <input type="checkbox" id="agreeTerms" name="terms" required value="agree">
            <label for="agreeTerms">
              I agree to the <a href="#" class="terms-link">terms and conditions</a>
            </label>
          </div>
        </div>

        <button type="submit" class="btn-register">Create Account</button>

        <div class="login-link">
          Already have an account? <a href="{{ route('login') }}">Sign In</a>
        </div>
      </form>
    </div>
    
    <div class="register-right">
      <div class="welcome-text">
        <h2>Member Benefits</h2>
        <p>Join our exclusive membership program and enjoy premium privileges</p>
      </div>
      
      <ul class="member-benefits">
        <li><i class="fas fa-percent"></i> Exclusive Member Discounts</li>
        <li><i class="fas fa-gift"></i> Special Birthday Offers</li>
        <li><i class="fas fa-clock"></i> Early Check-in & Late Check-out</li>
        <li><i class="fas fa-star"></i> Priority Room Upgrades</li>
        <li><i class="fas fa-coffee"></i> Complimentary Welcome Drink</li>
        <li><i class="fas fa-bolt"></i> Faster Booking Process</li>
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

    // Password strength indicator
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('password-strength');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordMatch = document.getElementById('password-match');

    passwordInput.addEventListener('input', function() {
      const password = this.value;
      let strength = '';
      let strengthClass = '';
      
      if (password.length === 0) {
        strength = '';
      } else if (password.length < 6) {
        strength = 'Weak';
        strengthClass = 'strength-weak';
      } else if (password.length < 8) {
        strength = 'Medium';
        strengthClass = 'strength-medium';
      } else {
        // Check for complexity
        const hasUpperCase = /[A-Z]/.test(password);
        const hasLowerCase = /[a-z]/.test(password);
        const hasNumbers = /\d/.test(password);
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        
        const complexityScore = [hasUpperCase, hasLowerCase, hasNumbers, hasSpecialChar].filter(Boolean).length;
        
        if (complexityScore >= 3) {
          strength = 'Strong';
          strengthClass = 'strength-strong';
        } else {
          strength = 'Medium';
          strengthClass = 'strength-medium';
        }
      }
      
      if (strength) {
        passwordStrength.textContent = `Password strength: ${strength}`;
        passwordStrength.className = `password-strength ${strengthClass}`;
      } else {
        passwordStrength.textContent = '';
      }
    });

    // Password match indicator
    confirmPasswordInput.addEventListener('input', function() {
      const password = passwordInput.value;
      const confirmPassword = this.value;
      
      if (confirmPassword.length === 0) {
        passwordMatch.textContent = '';
      } else if (password === confirmPassword) {
        passwordMatch.textContent = 'Passwords match';
        passwordMatch.className = 'password-strength strength-strong';
      } else {
        passwordMatch.textContent = 'Passwords do not match';
        passwordMatch.className = 'password-strength strength-weak';
      }
    });
  </script>
</body>
</html>
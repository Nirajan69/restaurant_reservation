<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Reservation System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            width: 360px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .logo {
        display: block;
        margin: 0 auto 20px auto;
        width: 150px; /* Adjust the width to make it larger */
        height: auto;
    }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 24px;
        }

        .form-group {
            margin-bottom: 16px;
            text-align: left;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .remember-me input {
            margin-right: 8px;
        }

        .remember-me label {
            font-size: 14px;
            color: #666;
        }

        .submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #6366f1;
            color: white;
            font-size: 14px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
        }

        .forgot-password {
            margin-top: 16px;
            font-size: 14px;
        }

        .forgot-password a {
            color: #6366f1;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Logo -->
        {{-- <img src="https://via.placeholder.com/64?text=Food" alt="Restaurant Logo" class="logo"> --}}
        <img src="{{ asset('images/logo.jpg') }}" alt="Restaurant Logo" class="logo">


        <!-- Title -->
        <h2 class="title">Restaurant Reservation System</h2>
        <p class="subtitle">Please enter your user information.</p>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">Username or Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password">
                @error('password')
                <span style="color: red; font-size: 12px;">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="remember-me">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="submit-btn">Sign in</button>

            <!-- Forgot Password -->
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">Forgot your password?</a>
            </div>
        </form>
    </div>
</body>
</html>

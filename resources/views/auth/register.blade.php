<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Restaurant Reservation System</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            width: 360px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 20px;
            font-weight: bold;
            color: #333333;
            text-align: center;
            margin-bottom: 16px;
        }

        p {
            font-size: 14px;
            color: #666666;
            text-align: center;
            margin-bottom: 24px;
        }

        .input-label {
            display: block;
            font-size: 14px;
            color: #333333;
            margin-bottom: 8px;
        }

        .text-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333333;
            margin-bottom: 16px;
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
            font-size: 14px;
            color: #6366f1;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 16px;
        }

        .back-to-login {
            font-size: 14px;
            color: #6366f1;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 16px;
        }

        /* Centering Already Registered Link */
        .centered {
            text-align: center;
        }



    .logo {
        display: block;
        margin: 0 auto 20px auto;
        width: 150px; /* Adjust the width to make it larger */
        height: auto;
    }
</style>

    </style>
</head>
<body>

    <div class="form-container">
        <!-- Logo Image -->
        {{-- <img src="{{ asset('images/logo.jpg') }}" alt="Restaurant Logo" class="logo"> --}}
        <img src="{{ asset('images/logo.jpg') }}" alt="Restaurant Logo" class="logo">


        <!-- Title -->
        <h2>Restaurant Reservation System</h2>
        <p>Please enter your user information to register.</p>

        <!-- Register Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="input-label">Name</label>
                <input id="name" class="text-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                @error('name')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="input-label">Email</label>
                <input id="email" class="text-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                @error('email')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="input-label">Password</label>
                <input id="password" class="text-input" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="input-label">Confirm Password</label>
                <input id="password_confirmation" class="text-input" type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <div style="color: red; font-size: 12px;">{{ $message }}</div>
                @enderror
            </div>

            <!-- Register Button -->
            <button type="submit" class="submit-btn">
                Register
            </button>

            <!-- Already registered link (Centered) -->
            <div class="centered">
                <a href="{{ route('login') }}" class="back-to-login">
                    Already registered?
                </a>
            </div>
        </form>
    </div>

</body>
</html>

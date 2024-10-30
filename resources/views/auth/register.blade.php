<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/bootstrap-5/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register') }}">
        <!-- CSRF Token -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <!-- Name -->
        <div>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" required autofocus>
            <span class="error">{{ $errors->first('name') }}</span>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" required>
            <span class="error">{{ $errors->first('email') }}</span>
        </div>

        <!-- Password -->
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required>
            <span class="error">{{ $errors->first('password') }}</span>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            <span class="error">{{ $errors->first('password_confirmation') }}</span>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
    <p>Already registered? <a href="/login">Login</a></p>
</div>
</body>
</html>

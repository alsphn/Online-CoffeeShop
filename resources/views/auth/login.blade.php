@section('title', 'Login')

<x-guest-layout>
    <!-- Left Side - Welcome Message -->
    <div class="auth-left">
        <i class="fas fa-coffee"></i>
        <h2>Welcome Back!</h2>
        <p>Login to access your account and enjoy our premium coffee selection</p>
        <div class="mt-4">
            <p class="mb-2">Don't have an account?</p>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-user-plus"></i> Create Account
            </a>
        </div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="auth-right">
        <div class="brand-logo">
            <i class="fas fa-coffee"></i>
            <h3>Online CoffeeShop</h3>
            <p class="text-muted">Sign in to your account</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
        <div class="alert alert-success mb-4">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    placeholder="Enter your email">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-lock"></i> Password
                </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password"
                    placeholder="Enter your password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                    <label class="form-check-label" for="remember_me">
                        Remember me
                    </label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-link">
                    Forgot Password?
                </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-link">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
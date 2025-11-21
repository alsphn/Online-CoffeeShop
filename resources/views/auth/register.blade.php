@section('title', 'Register')

<x-guest-layout>
    <!-- Left Side - Welcome Message -->
    <div class="auth-left">
        <i class="fas fa-user-plus"></i>
        <h2>Join Us Today!</h2>
        <p>Create an account and start enjoying our premium coffee collection with exclusive member benefits</p>
        <div class="mt-4">
            <p class="mb-2">Already have an account?</p>
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                <i class="fas fa-sign-in-alt"></i> Login Now
            </a>
        </div>
    </div>

    <!-- Right Side - Register Form -->
    <div class="auth-right">
        <div class="brand-logo">
            <i class="fas fa-coffee"></i>
            <h3>Online CoffeeShop</h3>
            <p class="text-muted">Create your account</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="fas fa-user"></i> Full Name
                </label>
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    placeholder="Enter your full name">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope"></i> Email Address
                </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="username"
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
                    name="password" required autocomplete="new-password"
                    placeholder="Create a password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Min. 8 characters</small>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label">
                    <i class="fas fa-lock"></i> Confirm Password
                </label>
                <input id="password_confirmation" type="password" class="form-control"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirm your password">
            </div>

            <!-- Submit Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus"></i> Create Account
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
@extends('layouts.guest')
@section('title', 'Sign In')

@section('content')
    <h1>Welcome back</h1>
    <p class="sub">Sign in to your SchoolSys account to continue.</p>

    @if($errors->any())
        <div class="alert-validation">
            <ul class="list-unstyled mb-0">
                @foreach($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">
                Password
                <span style="float:right;font-weight:400;color:#64748b">Min. 8 characters</span>
            </label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••" required>
                <button type="button" class="input-group-text" style="cursor:pointer;border-left:none"
                    onclick="togglePwd()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check mb-0">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:13px">Remember me</label>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
        </button>
    </form>

    <div class="divider">or</div>

    <p class="text-center mb-0" style="font-size:14px;color:#64748b">
        Don't have an account?
        <a href="{{ route('register') }}" class="auth-link">Register Here</a>
    </p>


    <script>
        function togglePwd() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                pwd.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
@endsection

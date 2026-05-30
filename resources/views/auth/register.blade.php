@extends('layouts.guest')
@section('title', 'Create Account')

@section('content')
    <h1>Create account</h1>
    <p class="sub">Join SchoolSys to manage academic records.</p>

    @if($errors->any())
        <div class="alert-validation">
            <ul class="list-unstyled mb-0">
                @foreach($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Juan Dela Cruz" value="{{ old('name') }}" required autofocus>
            </div>
            @error('name')
                <div class="text-danger mt-1" style="font-size:12px">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Student Number</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                <input type="text" name="student_number" class="form-control @error('student_number') is-invalid @enderror"
                    placeholder="2026-00001" value="{{ old('student_number') }}" required>
            </div>
            @error('student_number')
                <div class="text-danger mt-1" style="font-size:12px">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Department</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-building"></i></span>
                <select name="department_id" class="form-select @error('department_id') is-invalid @enderror" required @if($departments->isEmpty()) disabled @endif>
                    <option value="">{{ $departments->isEmpty() ? 'No departments available' : 'Select department' }}</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            @if($departments->isEmpty())
                <div class="text-warning mt-1" style="font-size:12px">No departments have been added yet. Please ask the administrator to create departments first.</div>
            @endif
            @error('department_id')
                <div class="text-danger mt-1" style="font-size:12px">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            @error('email')
                <div class="text-danger mt-1" style="font-size:12px">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Min. 8 characters" required>
                <button type="button" class="input-group-text" style="cursor:pointer;border-left:none"
                    onclick="togglePwd('password','eye1')">
                    <i class="bi bi-eye" id="eye1"></i>
                </button>
            </div>
            @error('password')
                <div class="text-danger mt-1" style="font-size:12px">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" id="password2"
                    class="form-control" placeholder="Re-enter password" required>
                <button type="button" class="input-group-text" style="cursor:pointer;border-left:none"
                    onclick="togglePwd('password2','eye2')">
                    <i class="bi bi-eye" id="eye2"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-person-plus me-2"></i> Create Account
        </button>
    </form>

    <div class="divider">already a member?</div>

    <p class="text-center mb-0" style="font-size:14px;color:#64748b">
        <a href="{{ route('login') }}" class="auth-link">Sign in to your account</a>
    </p>

    <script>
        function togglePwd(fieldId, iconId) {
            const pwd = document.getElementById(fieldId);
            const icon = document.getElementById(iconId);
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

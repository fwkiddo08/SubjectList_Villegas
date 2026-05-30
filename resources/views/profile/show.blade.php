@extends('layouts.app')
@section('title', 'My Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="page-header">
    <div>
        <h1>My Profile</h1>
        <p>Manage your personal information and account settings.</p>
    </div>
</div>

<div class="row g-3">
    {{-- Left: Avatar & Info Card --}}
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body text-center p-4">
                {{-- Avatar Upload --}}
                <form action="{{ route('profile.avatar') }}" method="POST" enctype="multipart/form-data" id="avatarForm">
                    @csrf
                    <div class="d-flex justify-content-center mb-3">
                        <div class="avatar-upload-wrap">
                            @if($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar)))
                                <img src="{{ asset('uploads/avatars/' . $user->avatar) }}"
                                     alt="Avatar" class="avatar-lg" id="avatarPreview">
                            @else
                                <div class="avatar-placeholder" id="avatarPlaceholder">{{ $user->initials }}</div>
                                <img src="" alt="" class="avatar-lg d-none" id="avatarPreview">
                            @endif
                            <label for="avatarInput" title="Change photo">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                    </div>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" class="d-none"
                        onchange="previewAvatar(this)">
                </form>

                <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                <p class="text-muted mb-3" style="font-size:13px">{{ $user->email }}</p>

                @if($user->student_number)
                    <div class="text-muted mb-2" style="font-size:13px">Student Number</div>
                    <div class="fw-semibold mb-3">{{ $user->student_number }}</div>
                @endif

                @if($user->department)
                    <div class="text-muted mb-2" style="font-size:13px">Department</div>
                    <div class="fw-semibold mb-3">{{ $user->department->name }}</div>
                @endif

                <span class="badge px-3 py-2 {{ $user->isAdmin() ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success' }}">
                    <i class="bi bi-{{ $user->isAdmin() ? 'shield-fill' : 'person-fill' }} me-1"></i>
                    {{ ucfirst($user->role) }}
                </span>

                <hr class="my-3">

                <div class="text-start" style="font-size:13px">
                    @if($user->gender)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-gender-ambiguous text-muted" style="width:16px"></i>
                        <span>{{ $user->gender }}</span>
                    </div>
                    @endif
                    @if($user->phone)
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-telephone text-muted" style="width:16px"></i>
                        <span>{{ $user->phone }}</span>
                    </div>
                    @endif
                    @if($user->address)
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="bi bi-geo-alt text-muted mt-1" style="width:16px"></i>
                        <span>{{ $user->address }}</span>
                    </div>
                    @endif
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar text-muted" style="width:16px"></i>
                        <span>Joined {{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Right: Edit Forms --}}
    <div class="col-lg-8">
        {{-- Profile Info --}}
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-person-lines-fill text-primary"></i> Personal Information
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Student Number</label>
                            <input type="text" name="student_number" class="form-control @error('student_number') is-invalid @enderror"
                                value="{{ old('student_number', $user->student_number) }}">
                            @error('student_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">— Select —</option>
                                @foreach(['Male','Female','Other','Prefer not to say'] as $g)
                                    <option value="{{ $g }}" {{ old('gender', $user->gender) == $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="09XXXXXXXXX"
                                value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2"
                                placeholder="Street, City, Province">{{ old('address', $user->address) }}</textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Change Password --}}
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lock-fill text-warning"></i> Change Password
            </div>
            <div class="card-body">
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Enter current password" required>
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Min. 8 characters" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation"
                                class="form-control" placeholder="Re-enter new password" required>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-lock me-1"></i> Change Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatarPreview');
            const placeholder = document.getElementById('avatarPlaceholder');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
            if (placeholder) placeholder.classList.add('d-none');
        };
        reader.readAsDataURL(input.files[0]);
        // Auto-submit
        document.getElementById('avatarForm').submit();
    }
}
</script>
@endpush

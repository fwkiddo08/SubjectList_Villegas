<?php $__env->startSection('title', 'My Profile'); ?>
<?php $__env->startSection('page-title', 'My Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>My Profile</h1>
        <p>Manage your personal information and account settings.</p>
    </div>
</div>

<div class="row g-3">
    
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body text-center p-4">
                
                <form action="<?php echo e(route('profile.avatar')); ?>" method="POST" enctype="multipart/form-data" id="avatarForm">
                    <?php echo csrf_field(); ?>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="avatar-upload-wrap">
                            <?php if($user->avatar && file_exists(public_path('uploads/avatars/' . $user->avatar))): ?>
                                <img src="<?php echo e(asset('uploads/avatars/' . $user->avatar)); ?>"
                                     alt="Avatar" class="avatar-lg" id="avatarPreview">
                            <?php else: ?>
                                <div class="avatar-placeholder" id="avatarPlaceholder"><?php echo e($user->initials); ?></div>
                                <img src="" alt="" class="avatar-lg d-none" id="avatarPreview">
                            <?php endif; ?>
                            <label for="avatarInput" title="Change photo">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                        </div>
                    </div>
                    <input type="file" id="avatarInput" name="avatar" accept="image/*" class="d-none"
                        onchange="previewAvatar(this)">
                </form>

                <h5 class="fw-bold mb-0"><?php echo e($user->name); ?></h5>
                <p class="text-muted mb-3" style="font-size:13px"><?php echo e($user->email); ?></p>

                <span class="badge px-3 py-2 <?php echo e($user->isAdmin() ? 'bg-primary-subtle text-primary' : 'bg-success-subtle text-success'); ?>">
                    <i class="bi bi-<?php echo e($user->isAdmin() ? 'shield-fill' : 'person-fill'); ?> me-1"></i>
                    <?php echo e(ucfirst($user->role)); ?>

                </span>

                <hr class="my-3">

                <div class="text-start" style="font-size:13px">
                    <?php if($user->gender): ?>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-gender-ambiguous text-muted" style="width:16px"></i>
                        <span><?php echo e($user->gender); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($user->phone): ?>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <i class="bi bi-telephone text-muted" style="width:16px"></i>
                        <span><?php echo e($user->phone); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if($user->address): ?>
                    <div class="d-flex align-items-start gap-2 mb-2">
                        <i class="bi bi-geo-alt text-muted mt-1" style="width:16px"></i>
                        <span><?php echo e($user->address); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-calendar text-muted" style="width:16px"></i>
                        <span>Joined <?php echo e($user->created_at->format('M d, Y')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="col-lg-8">
        
        <div class="card mb-3">
            <div class="card-header">
                <i class="bi bi-person-lines-fill text-primary"></i> Personal Information
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('profile.update')); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('name', $user->name)); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                value="<?php echo e(old('email', $user->email)); ?>" required>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">— Select —</option>
                                <?php $__currentLoopData = ['Male','Female','Other','Prefer not to say']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($g); ?>" <?php echo e(old('gender', $user->gender) == $g ? 'selected' : ''); ?>><?php echo e($g); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="09XXXXXXXXX"
                                value="<?php echo e(old('phone', $user->phone)); ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2"
                                placeholder="Street, City, Province"><?php echo e(old('address', $user->address)); ?></textarea>
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

        
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lock-fill text-warning"></i> Change Password
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('profile.password')); ?>" method="POST">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input type="password" name="current_password"
                                class="form-control <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Enter current password" required>
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <input type="password" name="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Min. 8 characters" required>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views\profile\show.blade.php ENDPATH**/ ?>
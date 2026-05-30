<?php $edit = $edit ?? false; $p = $edit ? 'edit_' : ''; ?>

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Subject Code <span class="text-danger">*</span></label>
        <input type="text" name="<?php echo e($p); ?>code" class="form-control <?php $__errorArgs = [$p.'code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            placeholder="e.g. CS101"
            value="<?php echo e(old($p.'code')); ?>" required maxlength="20"
            style="text-transform:uppercase" oninput="this.value=this.value.toUpperCase()">
        <?php $__errorArgs = [$p.'code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-8">
        <label class="form-label">Subject Name <span class="text-danger">*</span></label>
        <input type="text" name="<?php echo e($p); ?>name" class="form-control <?php $__errorArgs = [$p.'name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            placeholder="e.g. Introduction to Programming"
            value="<?php echo e(old($p.'name')); ?>" required>
        <?php $__errorArgs = [$p.'name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="<?php echo e($p); ?>description" class="form-control" rows="2"
            placeholder="Brief description of the subject…"><?php echo e(old($p.'description')); ?></textarea>
    </div>
    <div class="col-md-3">
        <label class="form-label">Units <span class="text-danger">*</span></label>
        <input type="number" name="<?php echo e($p); ?>units" class="form-control <?php $__errorArgs = [$p.'units'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            min="1" max="10" placeholder="3"
            value="<?php echo e(old($p.'units', 3)); ?>" required>
        <?php $__errorArgs = [$p.'units'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-3">
        <label class="form-label">Type <span class="text-danger">*</span></label>
        <select name="<?php echo e($p); ?>type" class="form-select <?php $__errorArgs = [$p.'type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <option value="lecture" <?php echo e(old($p.'type','lecture') == 'lecture' ? 'selected' : ''); ?>>Lecture</option>
            <option value="lab"     <?php echo e(old($p.'type') == 'lab'     ? 'selected' : ''); ?>>Laboratory</option>
            <option value="seminar" <?php echo e(old($p.'type') == 'seminar' ? 'selected' : ''); ?>>Seminar</option>
        </select>
        <?php $__errorArgs = [$p.'type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-3">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="<?php echo e($p); ?>status" class="form-select <?php $__errorArgs = [$p.'status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
            <option value="active"   <?php echo e(old($p.'status','active') == 'active'   ? 'selected' : ''); ?>>Active</option>
            <option value="inactive" <?php echo e(old($p.'status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
        </select>
        <?php $__errorArgs = [$p.'status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-3">
        <label class="form-label">Department</label>
        <select name="<?php echo e($p); ?>department_id" class="form-select">
            <option value="">— None —</option>
            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($dept->id); ?>" <?php echo e(old($p.'department_id') == $dept->id ? 'selected' : ''); ?>>
                    <?php echo e($dept->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views/subjects/_form.blade.php ENDPATH**/ ?>
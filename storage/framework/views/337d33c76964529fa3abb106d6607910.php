<?php $edit = $edit ?? false; $p = $edit ? 'edit_' : ''; ?>

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Department Name <span class="text-danger">*</span></label>
        <input type="text" name="<?php echo e($p); ?>name"
            class="form-control <?php $__errorArgs = [$p.'name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            placeholder="e.g. Computer Science"
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
    <div class="col-md-4">
        <label class="form-label">Code <span class="text-danger">*</span></label>
        <input type="text" name="<?php echo e($p); ?>code"
            class="form-control <?php $__errorArgs = [$p.'code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
            placeholder="e.g. CS"
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
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="<?php echo e($p); ?>description" class="form-control" rows="2"
            placeholder="Brief description…"><?php echo e(old($p.'description')); ?></textarea>
    </div>
    <div class="col-md-8">
        <label class="form-label">Department Head / Chair</label>
        <input type="text" name="<?php echo e($p); ?>head" class="form-control"
            placeholder="e.g. Dr. Jose Reyes" value="<?php echo e(old($p.'head')); ?>">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="<?php echo e($p); ?>status" class="form-select" required>
            <option value="active"   <?php echo e(old($p.'status','active') == 'active'   ? 'selected':''); ?>>Active</option>
            <option value="inactive" <?php echo e(old($p.'status') == 'inactive' ? 'selected':''); ?>>Inactive</option>
        </select>
    </div>
</div>
<?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views\departments\_form.blade.php ENDPATH**/ ?>
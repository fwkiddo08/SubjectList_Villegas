<?php $__env->startSection('title', 'Subjects'); ?>
<?php $__env->startSection('page-title', 'Subjects'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1>Subject List</h1>
        <p>Manage all academic subjects across departments.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-lg me-1"></i> Add Subject
    </button>
</div>


<div class="card mb-3">
    <div class="card-body py-3">
        <form method="GET" action="<?php echo e(route('subjects.index')); ?>" class="row g-2 align-items-end">
            <div class="col-12 col-md-4">
                <div class="search-bar">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" class="form-control"
                        placeholder="Search code, name…" value="<?php echo e(request('search')); ?>">
                </div>
            </div>
            <div class="col-6 col-md-2">
                <select name="department_id" class="form-select">
                    <option value="">All Departments</option>
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($dept->id); ?>" <?php echo e(request('department_id') == $dept->id ? 'selected' : ''); ?>>
                            <?php echo e($dept->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="type" class="form-select">
                    <option value="">All Types</option>
                    <option value="lecture"  <?php echo e(request('type') == 'lecture'  ? 'selected' : ''); ?>>Lecture</option>
                    <option value="lab"      <?php echo e(request('type') == 'lab'      ? 'selected' : ''); ?>>Lab</option>
                    <option value="seminar"  <?php echo e(request('type') == 'seminar'  ? 'selected' : ''); ?>>Seminar</option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <select name="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="active"   <?php echo e(request('status') == 'active'   ? 'selected' : ''); ?>>Active</option>
                    <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                </select>
            </div>
            <div class="col-6 col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel"></i> Filter
                </button>
                <a href="<?php echo e(route('subjects.index')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-x"></i>
                </a>
            </div>
        </form>
    </div>
</div>


<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-journal-text text-primary me-1"></i> Subjects
            <span class="badge bg-primary-subtle text-primary ms-2"><?php echo e($subjects->total()); ?></span>
        </span>
        <div class="d-flex gap-1">
            <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'name','dir'=> request('dir')=='asc'?'desc':'asc'])); ?>"
               class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-sort-alpha-down"></i>
            </a>
            <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'units','dir'=> request('dir')=='asc'?'desc':'asc'])); ?>"
               class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-123"></i>
            </a>
        </div>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>
                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'code','dir'=>request('dir')=='asc'?'desc':'asc'])); ?>"
                           class="text-muted text-decoration-none">Code <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>
                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'name','dir'=>request('dir')=='asc'?'desc':'asc'])); ?>"
                           class="text-muted text-decoration-none">Subject Name <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>Department</th>
                    <th>
                        <a href="<?php echo e(request()->fullUrlWithQuery(['sort'=>'units','dir'=>request('dir')=='asc'?'desc':'asc'])); ?>"
                           class="text-muted text-decoration-none">Units <i class="bi bi-chevron-expand"></i></a>
                    </th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-muted"><?php echo e($subjects->firstItem() + $i); ?></td>
                    <td><code><?php echo e($subject->code); ?></code></td>
                    <td>
                        <div class="fw-semibold"><?php echo e($subject->name); ?></div>
                        <?php if($subject->description): ?>
                            <div class="text-muted" style="font-size:12px;max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">
                                <?php echo e($subject->description); ?>

                            </div>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($subject->department?->name ?? '—'); ?></td>
                    <td>
                        <span class="fw-semibold"><?php echo e($subject->units); ?></span>
                        <span class="text-muted" style="font-size:11px"> unit<?php echo e($subject->units > 1 ? 's' : ''); ?></span>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo e($subject->type_badge); ?>-subtle text-<?php echo e($subject->type_badge); ?>">
                            <?php echo e(ucfirst($subject->type)); ?>

                        </span>
                    </td>
                    <td>
                        <span class="badge bg-<?php echo e($subject->status_badge); ?>-subtle text-<?php echo e($subject->status_badge); ?>">
                            <?php echo e(ucfirst($subject->status)); ?>

                        </span>
                    </td>
                    <td class="text-muted" style="font-size:12px"><?php echo e($subject->created_at->format('M d, Y')); ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-icon btn-outline-primary btn-sm"
                                title="Edit"
                                onclick="openEdit(<?php echo e($subject->id); ?>, <?php echo json_encode($subject, 15, 512) ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form id="del-<?php echo e($subject->id); ?>"
                                action="<?php echo e(route('subjects.destroy', $subject)); ?>"
                                method="POST" style="display:inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="button"
                                    class="btn btn-icon btn-outline-danger btn-sm"
                                    title="Delete"
                                    onclick="confirmDelete('del-<?php echo e($subject->id); ?>', '<?php echo e(addslashes($subject->name)); ?>')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center py-5">
                        <i class="bi bi-journal-x" style="font-size:40px;color:#cbd5e1;display:block;margin-bottom:8px"></i>
                        <div class="text-muted">No subjects found.</div>
                        <?php if(request()->hasAny(['search','department_id','type','status'])): ?>
                            <a href="<?php echo e(route('subjects.index')); ?>" class="btn btn-sm btn-outline-primary mt-2">Clear Filters</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($subjects->hasPages()): ?>
    <div class="card-body pt-0 d-flex justify-content-between align-items-center">
        <span class="text-muted" style="font-size:13px">
            Showing <?php echo e($subjects->firstItem()); ?>–<?php echo e($subjects->lastItem()); ?> of <?php echo e($subjects->total()); ?> subjects
        </span>
        <?php echo e($subjects->withQueryString()->links('pagination::bootstrap-5')); ?>

    </div>
    <?php endif; ?>
</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo e(route('subjects.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle text-primary me-2"></i>Add New Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('subjects._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg me-1"></i> Save Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square text-warning me-2"></i>Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <?php echo $__env->make('subjects._form', ['edit' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-check-lg me-1"></i> Update Subject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function openEdit(id, data) {
    const form = document.getElementById('editForm');
    form.action = `/subjects/${id}`;
    form.querySelector('[name=edit_code]').value        = data.code;
    form.querySelector('[name=edit_name]').value        = data.name;
    form.querySelector('[name=edit_description]').value = data.description || '';
    form.querySelector('[name=edit_units]').value       = data.units;
    form.querySelector('[name=edit_type]').value        = data.type;
    form.querySelector('[name=edit_status]').value      = data.status;
    form.querySelector('[name=edit_department_id]').value = data.department_id || '';
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

// Re-open modal on validation error
<?php if($errors->any()): ?>
    <?php if(old('edit_code')): ?>
        new bootstrap.Modal(document.getElementById('editModal')).show();
    <?php else: ?>
        new bootstrap.Modal(document.getElementById('addModal')).show();
    <?php endif; ?>
<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views\subjects\index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page-title', auth()->user()->isStudent() ? 'Student Dashboard' : 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div>
        <h1><?php echo e(auth()->user()->isStudent() ? 'Student Dashboard' : 'Dashboard'); ?></h1>
        <p>Welcome back, <?php echo e(auth()->user()->name); ?>! Here's what's happening.</p>
        <?php if(auth()->user()->isStudent()): ?>
            <p class="text-muted mb-0">
                Subjects are filtered by your department: <strong><?php echo e($studentDepartment?->name ?? 'Unassigned'); ?></strong>.
                <?php if (! ($studentDepartment)): ?>
                    You can still browse available subjects while your department is being assigned.
                <?php endif; ?>
            </p>
        <?php endif; ?>
    </div>
    <div class="d-flex gap-2">
        <?php if(auth()->user()->isAdmin()): ?>
            <a href="<?php echo e(route('subjects.index')); ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Add Subject
            </a>
        <?php endif; ?>
    </div>
</div>


<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eef2ff;color:#4f46e5">
                <i class="bi bi-journal-text"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#4f46e5"><?php echo e($stats['total_subjects']); ?></div>
                <div class="stat-label">Total Subjects</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#ecfdf5;color:#10b981">
                <i class="bi bi-check-circle"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#10b981"><?php echo e($stats['active_subjects']); ?></div>
                <div class="stat-label">Active Subjects</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#fff7ed;color:#f59e0b">
                <i class="bi bi-building"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#f59e0b"><?php echo e($stats['total_departments']); ?></div>
                <div class="stat-label"><?php echo e(auth()->user()->isStudent() ? 'Department' : 'Departments'); ?></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:#f0fdfa;color:#06b6d4">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-value" style="color:#06b6d4"><?php echo e($stats['total_users']); ?></div>
                <div class="stat-label">Users</div>
            </div>
        </div>
    </div>
</div>


<div class="row g-3 mb-4">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-bar-chart-fill text-primary"></i>
                Subjects per Department
            </div>
            <div class="card-body">
                <canvas id="deptChart" height="220"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-pie-chart-fill text-warning"></i>
                Subjects by Type
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="typeChart" height="220"></canvas>
            </div>
        </div>
    </div>
</div>


<div class="row g-3">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span>
                    <i class="bi bi-clock-history text-primary me-1"></i>
                    <?php echo e(auth()->user()->isStudent() ? 'Your Department Subjects' : 'Recently Added Subjects'); ?>

                </span>
                <a href="<?php echo e(route('subjects.index')); ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Description</th>
                            <th>Units</th>
                            <th>Department</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><code><?php echo e($subject->code); ?></code></td>
                            <td class="fw-semibold"><?php echo e($subject->name); ?></td>
                            <td class="text-muted" style="max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo e($subject->description); ?></td>
                            <td><?php echo e($subject->units); ?></td>
                            <td><?php echo e($subject->department?->name ?? '—'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo e($subject->status_badge); ?>-subtle text-<?php echo e($subject->status_badge); ?>">
                                    <?php echo e(ucfirst($subject->status)); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">No subjects found.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(auth()->user()->isStudent()): ?>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-2 g-3 mt-3">
                    <?php $__empty_1 = true; $__currentLoopData = $recentSubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <div class="text-muted small">Code</div>
                                        <div class="fw-semibold"><?php echo e($subject->code); ?></div>
                                    </div>
                                    <span class="badge bg-<?php echo e($subject->status_badge); ?>-subtle text-<?php echo e($subject->status_badge); ?>"><?php echo e(ucfirst($subject->status)); ?></span>
                                </div>
                                <h5 class="card-title mb-2"><?php echo e($subject->name); ?></h5>
                                <p class="card-text text-muted mb-3"><?php echo e($subject->description); ?></p>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-primary-subtle text-primary">Units: <?php echo e($subject->units); ?></span>
                                    <span class="badge bg-secondary-subtle text-secondary"><?php echo e($subject->department?->name ?? '—'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-12 text-center text-muted py-4">No subjects available for your department.</div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-activity text-success me-1"></i> Subject Status
            </div>
            <div class="card-body">
                <canvas id="statusChart" height="180"></canvas>
                <div class="d-flex justify-content-center gap-4 mt-3">
                    <div class="text-center">
                        <div class="fw-bold" style="font-size:22px;color:#10b981"><?php echo e($activeCount); ?></div>
                        <div style="font-size:12px;color:#64748b">Active</div>
                    </div>
                    <div style="width:1px;background:#e2e8f0"></div>
                    <div class="text-center">
                        <div class="fw-bold" style="font-size:22px;color:#ef4444"><?php echo e($inactiveCount); ?></div>
                        <div style="font-size:12px;color:#64748b">Inactive</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
const chartDefaults = {
    font: { family: 'Plus Jakarta Sans' }
};
Chart.defaults.font.family = 'Plus Jakarta Sans';

// Department bar chart
const deptData = <?php echo json_encode($subjectsByDept, 15, 512) ?>;
new Chart(document.getElementById('deptChart'), {
    type: 'bar',
    data: {
        labels: deptData.map(d => d.name),
        datasets: [{
            label: 'Subjects',
            data: deptData.map(d => d.count),
            backgroundColor: [
                'rgba(79,70,229,.8)',
                'rgba(6,182,212,.8)',
                'rgba(16,185,129,.8)',
                'rgba(245,158,11,.8)',
                'rgba(239,68,68,.8)',
            ],
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1, font: { size: 12 } },
                grid: { color: 'rgba(0,0,0,.05)' }
            },
            x: { ticks: { font: { size: 11 } }, grid: { display: false } }
        }
    }
});

// Type doughnut chart
const typeData = <?php echo json_encode($subjectsByType, 15, 512) ?>;
new Chart(document.getElementById('typeChart'), {
    type: 'doughnut',
    data: {
        labels: typeData.map(d => d.type),
        datasets: [{
            data: typeData.map(d => d.count),
            backgroundColor: ['rgba(79,70,229,.85)', 'rgba(16,185,129,.85)', 'rgba(245,158,11,.85)'],
            borderWidth: 3,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        cutout: '65%',
        plugins: {
            legend: {
                position: 'bottom',
                labels: { padding: 16, font: { size: 12 } }
            }
        }
    }
});

// Status doughnut
new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Inactive'],
        datasets: [{
            data: [<?php echo e($activeCount); ?>, <?php echo e($inactiveCount); ?>],
            backgroundColor: ['rgba(16,185,129,.85)', 'rgba(239,68,68,.85)'],
            borderWidth: 3,
            borderColor: '#fff',
        }]
    },
    options: {
        responsive: true,
        cutout: '70%',
        plugins: {
            legend: { position: 'bottom', labels: { padding: 16, font: { size: 12 } } }
        }
    }
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views/dashboard/index.blade.php ENDPATH**/ ?>
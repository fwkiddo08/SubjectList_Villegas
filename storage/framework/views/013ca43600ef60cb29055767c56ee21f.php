<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?> — SchoolSys</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand: #4f46e5;
            --brand-dark: #3730a3;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            margin: 0;
            background: #f1f5f9;
        }

        .auth-left {
            width: 480px;
            flex-shrink: 0;
            background: linear-gradient(160deg, #1e1b4b 0%, #312e81 40%, #4338ca 70%, #6366f1 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .auth-left::before {
            content: '';
            position: absolute;
            width: 400px; height: 400px;
            border-radius: 50%;
            border: 60px solid rgba(255,255,255,.05);
            top: -100px; right: -100px;
        }

        .auth-left::after {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            border: 40px solid rgba(255,255,255,.04);
            bottom: -80px; left: -80px;
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 48px;
            z-index: 1;
        }

        .auth-brand-icon {
            width: 52px; height: 52px;
            background: rgba(255,255,255,.15);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: #fff;
            border: 1px solid rgba(255,255,255,.2);
        }

        .auth-brand-name {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.5px;
        }

        .auth-illustration {
            z-index: 1;
            text-align: center;
        }

        .auth-illustration .big-icon {
            font-size: 80px;
            margin-bottom: 24px;
            display: block;
            filter: drop-shadow(0 0 30px rgba(165,180,252,.5));
        }

        .auth-illustration h2 {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            margin-bottom: 12px;
        }

        .auth-illustration p {
            color: rgba(255,255,255,.65);
            font-size: 15px;
            line-height: 1.6;
        }

        .auth-features {
            margin-top: 40px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 1;
            width: 100%;
        }

        .auth-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,.8);
            font-size: 14px;
        }

        .auth-feature i {
            width: 28px; height: 28px;
            background: rgba(255,255,255,.1);
            border-radius: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
            color: #a5b4fc;
        }

        .auth-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 40px;
        }

        .auth-form-card {
            width: 100%;
            max-width: 420px;
        }

        .auth-form-card h1 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .auth-form-card .sub {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 8px;
            border: 1.5px solid #e2e8f0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 14px;
            padding: 10px 14px;
            transition: all .2s;
        }

        .form-control:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }

        .btn-auth {
            background: linear-gradient(135deg, var(--brand) 0%, #6366f1 100%);
            color: #fff;
            border: none;
            padding: 12px;
            font-weight: 700;
            font-size: 15px;
            border-radius: 8px;
            width: 100%;
            cursor: pointer;
            transition: all .2s;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .btn-auth:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(79,70,229,.35);
        }

        .input-group-text {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            color: #94a3b8;
            border-radius: 8px;
        }

        .input-group .form-control {
            border-left: none;
            border-radius: 0 8px 8px 0;
        }

        .input-group .input-group-text {
            border-right: none;
            border-radius: 8px 0 0 8px;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94a3b8;
            font-size: 12px;
            margin: 24px 0;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .auth-link {
            color: var(--brand);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-link:hover { text-decoration: underline; }

        .alert-validation {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 20px;
        }

        .alert-validation li {
            color: #dc2626;
            font-size: 13px;
            margin-bottom: 2px;
        }

        @media (max-width: 768px) {
            .auth-left { display: none; }
        }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 20px; right: 20px;
            z-index: 9999;
        }

        .toast-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,.15);
            border-left: 4px solid;
            min-width: 300px;
            animation: slideIn .3s ease forwards;
            position: relative;
            overflow: hidden;
        }

        .toast-item.success { border-color: #10b981; }
        .toast-item.error   { border-color: #ef4444; }

        .toast-icon { font-size: 18px; }
        .toast-item.success .toast-icon { color: #10b981; }
        .toast-item.error   .toast-icon { color: #ef4444; }

        .toast-progress {
            position: absolute;
            bottom: 0; left: 0;
            height: 3px;
            animation: progress 4s linear forwards;
        }

        .toast-item.success .toast-progress { background: #10b981; }
        .toast-item.error   .toast-progress { background: #ef4444; }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to   { transform: translateX(0); opacity: 1; }
        }

        @keyframes progress {
            from { width: 100%; }
            to   { width: 0; }
        }
    </style>
</head>
<body>
    <div class="auth-left">
        <div class="auth-brand">
            <div class="auth-brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div class="auth-brand-name">SchoolSys</div>
        </div>
        <div class="auth-illustration">
            <span class="big-icon">🎓</span>
            <h2>School Management Portal</h2>
            <p>Manage subjects, departments, and academic records in one organized platform.</p>
        </div>
        <div class="auth-features">
            <div class="auth-feature">
                <i class="bi bi-journal-bookmark-fill"></i>
                Full subject catalog management
            </div>
            <div class="auth-feature">
                <i class="bi bi-building-fill"></i>
                Department organization tools
            </div>
            <div class="auth-feature">
                <i class="bi bi-bar-chart-fill"></i>
                Dashboard with live analytics
            </div>
            <div class="auth-feature">
                <i class="bi bi-shield-check-fill"></i>
                Secure role-based access
            </div>
        </div>
    </div>

    <div class="auth-right">
        <div class="auth-form-card">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showToast(message, type = 'success') {
            const icons = { success: 'bi-check-circle-fill', error: 'bi-x-circle-fill' };
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-item ${type}`;
            toast.innerHTML = `
                <i class="bi ${icons[type]} toast-icon"></i>
                <span style="font-size:13.5px;font-weight:500">${message}</span>
                <div class="toast-progress"></div>
            `;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 4200);
        }
        <?php if(session('toast_success')): ?>
            showToast(<?php echo json_encode(session('toast_success'), 15, 512) ?>, 'success');
        <?php endif; ?>
        <?php if(session('toast_error')): ?>
            showToast(<?php echo json_encode(session('toast_error'), 15, 512) ?>, 'error');
        <?php endif; ?>
    </script>
</body>
</html>
<?php /**PATH C:\Users\Kerby\OneDrive\Documents\schoolapp\resources\views\layouts\guest.blade.php ENDPATH**/ ?>
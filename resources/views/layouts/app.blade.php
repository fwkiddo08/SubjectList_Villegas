<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SchoolSys</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --brand:        #4f46e5;
            --brand-dark:   #3730a3;
            --brand-light:  #eef2ff;
            --accent:       #06b6d4;
            --success:      #10b981;
            --warning:      #f59e0b;
            --danger:       #ef4444;
            --sidebar-w:    260px;
            --topbar-h:     64px;
            --bg:           #f1f5f9;
            --card:         #ffffff;
            --text:         #0f172a;
            --muted:        #64748b;
            --border:       #e2e8f0;
            --shadow:       0 1px 3px 0 rgb(0 0 0/.1),0 1px 2px -1px rgb(0 0 0/.1);
            --shadow-md:    0 4px 6px -1px rgb(0 0 0/.1),0 2px 4px -2px rgb(0 0 0/.1);
            --shadow-lg:    0 10px 15px -3px rgb(0 0 0/.1),0 4px 6px -4px rgb(0 0 0/.1);
            --radius:       12px;
            --radius-sm:    8px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            margin: 0;
            overflow-x: hidden;
        }

        /* ── SIDEBAR ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: linear-gradient(180deg, #1e1b4b 0%, #312e81 50%, #3730a3 100%);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(99,102,241,.2);
            pointer-events: none;
        }

        .sidebar-brand {
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }

        .brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #6366f1, #a78bfa);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #fff;
            flex-shrink: 0;
        }

        .brand-text {
            font-size: 18px;
            font-weight: 800;
            color: #fff;
            letter-spacing: -.3px;
        }

        .brand-sub {
            font-size: 10px;
            color: rgba(255,255,255,.5);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255,255,255,.35);
            padding: 8px 12px 4px;
            margin-top: 8px;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: rgba(255,255,255,.65);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
            position: relative;
        }

        .nav-link-item:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }

        .nav-link-item.active {
            background: rgba(99,102,241,.4);
            color: #fff;
            font-weight: 600;
        }

        .nav-link-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 8px; bottom: 8px;
            width: 3px;
            background: #a78bfa;
            border-radius: 0 3px 3px 0;
        }

        .nav-link-item i {
            font-size: 16px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            background: rgba(255,255,255,.06);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: background .2s;
        }

        .user-card:hover { background: rgba(255,255,255,.1); }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #a78bfa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 11px;
            color: rgba(255,255,255,.45);
        }

        /* ── TOPBAR ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: var(--card);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            z-index: 1030;
            gap: 16px;
            box-shadow: var(--shadow);
        }

        .topbar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 20px;
            color: var(--muted);
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
        }

        .topbar-title {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
        }

        .topbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-btn {
            width: 36px; height: 36px;
            border: none;
            background: var(--bg);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            cursor: pointer;
            font-size: 16px;
            transition: all .2s;
            text-decoration: none;
        }

        .topbar-btn:hover {
            background: var(--brand-light);
            color: var(--brand);
        }

        /* ── MAIN CONTENT ── */
        .main-content {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }

        .page-wrapper {
            padding: 28px 28px;
        }

        /* ── CARDS ── */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        .card-header {
            background: none;
            border-bottom: 1px solid var(--border);
            padding: 16px 20px;
            font-weight: 700;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body { padding: 20px; }

        /* ── STAT CARDS ── */
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--shadow);
            transition: all .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .stat-icon {
            width: 52px; height: 52px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            font-weight: 500;
        }

        /* ── TABLES ── */
        .table-wrapper {
            overflow-x: auto;
            border-radius: var(--radius);
        }

        .table {
            margin: 0;
            font-size: 13.5px;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid var(--border);
            font-weight: 700;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: var(--muted);
            padding: 12px 16px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 13px 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border);
        }

        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover td { background: #fafbff; }

        /* ── BADGES ── */
        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 100px;
        }

        /* ── BUTTONS ── */
        .btn {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            border-radius: var(--radius-sm);
            font-size: 13.5px;
        }

        .btn-primary {
            background: var(--brand);
            border-color: var(--brand);
        }

        .btn-primary:hover {
            background: var(--brand-dark);
            border-color: var(--brand-dark);
        }

        .btn-icon {
            width: 32px; height: 32px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
            font-size: 14px;
        }

        /* ── FORMS ── */
        .form-control, .form-select {
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--border);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13.5px;
            padding: 8px 12px;
            transition: all .2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(79,70,229,.12);
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 6px;
        }

        /* ── TOAST ── */
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            background: var(--card);
            border-radius: var(--radius-sm);
            box-shadow: var(--shadow-lg);
            border-left: 4px solid;
            min-width: 300px;
            max-width: 400px;
            animation: slideIn .35s cubic-bezier(.4,0,.2,1) forwards;
            position: relative;
            overflow: hidden;
        }

        .toast-item.success { border-color: var(--success); }
        .toast-item.error   { border-color: var(--danger); }
        .toast-item.warning { border-color: var(--warning); }
        .toast-item.info    { border-color: var(--accent); }

        .toast-icon {
            font-size: 18px;
            flex-shrink: 0;
        }

        .toast-item.success .toast-icon { color: var(--success); }
        .toast-item.error   .toast-icon { color: var(--danger); }
        .toast-item.warning .toast-icon { color: var(--warning); }
        .toast-item.info    .toast-icon { color: var(--accent); }

        .toast-msg {
            font-size: 13.5px;
            font-weight: 500;
            flex: 1;
            color: var(--text);
        }

        .toast-close {
            background: none;
            border: none;
            color: var(--muted);
            font-size: 16px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .toast-progress {
            position: absolute;
            bottom: 0; left: 0;
            height: 3px;
            animation: progress 4s linear forwards;
        }

        .toast-item.success .toast-progress { background: var(--success); }
        .toast-item.error   .toast-progress { background: var(--danger); }
        .toast-item.warning .toast-progress { background: var(--warning); }
        .toast-item.info    .toast-progress { background: var(--accent); }

        @keyframes slideIn {
            from { transform: translateX(120%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }

        @keyframes progress {
            from { width: 100%; }
            to   { width: 0%; }
        }

        /* ── MODAL ── */
        .modal-content {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--border);
            padding: 18px 24px;
        }

        .modal-title {
            font-weight: 700;
            font-size: 16px;
        }

        .modal-body { padding: 24px; }

        .modal-footer {
            border-top: 1px solid var(--border);
            padding: 16px 24px;
        }

        /* ── SEARCH BAR ── */
        .search-bar {
            position: relative;
        }

        .search-bar i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 14px;
        }

        .search-bar input {
            padding-left: 32px;
        }

        /* ── PAGE HEADER ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h1 {
            font-size: 22px;
            font-weight: 800;
            margin: 0;
            color: var(--text);
        }

        .page-header p {
            font-size: 13px;
            color: var(--muted);
            margin: 2px 0 0;
        }

        /* ── SIDEBAR OVERLAY ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 1039;
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .sidebar-overlay.show { display: block; }

            .topbar {
                left: 0;
            }

            .topbar-toggle { display: flex; }

            .main-content {
                margin-left: 0;
            }
        }

        /* ── AVATAR UPLOAD ── */
        .avatar-upload-wrap {
            position: relative;
            width: 100px;
            height: 100px;
        }

        .avatar-upload-wrap label {
            position: absolute;
            bottom: 0; right: 0;
            width: 30px; height: 30px;
            background: var(--brand);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 13px;
            cursor: pointer;
            border: 2px solid #fff;
        }

        .avatar-lg {
            width: 100px; height: 100px;
            border-radius: 50%;
            border: 3px solid var(--border);
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 100px; height: 100px;
            border-radius: 50%;
            border: 3px solid var(--border);
            background: linear-gradient(135deg, #6366f1, #a78bfa);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 800;
            color: #fff;
        }

        /* Pagination */
        .pagination {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0;
            padding: 0.35rem 0.75rem;
            min-width: 40px;
            font-size: 13px;
            font-weight: 600;
            color: var(--brand);
            border-color: var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pagination .page-item.active .page-link {
            background: var(--brand);
            border-color: var(--brand);
            color: #fff;
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background-color: #f8f9fa;
            border-color: #dee2e6;
            pointer-events: none;
        }

        .pagination .page-link svg,
        .pagination .page-link i {
            width: 1rem;
            height: 1rem;
        }

        code {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            background: var(--brand-light);
            color: var(--brand);
            padding: 2px 6px;
            border-radius: 4px;
        }
    </style>
    @stack('styles')
</head>
<body>
    {{-- Sidebar Overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    {{-- Sidebar --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <div class="brand-text">SchoolSys</div>
                <div class="brand-sub">Management Portal</div>
            </div>
        </div>

        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
            <div class="nav-section-label">Main</div>
            <a href="{{ route('dashboard') }}" class="nav-link-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i> Dashboard
            </a>
            @endif

            <div class="nav-section-label">Academic</div>
            <a href="{{ route('subjects.index') }}" class="nav-link-item {{ request()->routeIs('subjects.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Subjects
            </a>
            @if(auth()->user()->isAdmin())
            <a href="{{ route('departments.index') }}" class="nav-link-item {{ request()->routeIs('departments.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i> Departments
            </a>
            @endif

            <div class="nav-section-label">Account</div>
            <a href="{{ route('profile.show') }}" class="nav-link-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> My Profile
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ route('profile.show') }}" class="user-card text-decoration-none">
                <div class="user-avatar">
                    @if(auth()->user()->avatar && file_exists(public_path('uploads/avatars/' . auth()->user()->avatar)))
                        <img src="{{ asset('uploads/avatars/' . auth()->user()->avatar) }}" alt="">
                    @else
                        {{ auth()->user()->initials }}
                    @endif
                </div>
                <div class="overflow-hidden">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">{{ ucfirst(auth()->user()->role) }}</div>
                </div>
            </a>
        </div>
    </aside>

    {{-- Topbar --}}
    <header class="topbar">
        <button class="topbar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <a href="{{ route('profile.show') }}" class="topbar-btn" title="Profile">
                <i class="bi bi-person"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="topbar-btn" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </header>

    {{-- Main --}}
    <main class="main-content">
        <div class="page-wrapper">
            @yield('content')
        </div>
    </main>

    {{-- Toast Container --}}
    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        // Sidebar toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
        }

        // Toast system
        function showToast(message, type = 'success') {
            const icons = {
                success: 'bi-check-circle-fill',
                error:   'bi-x-circle-fill',
                warning: 'bi-exclamation-circle-fill',
                info:    'bi-info-circle-fill'
            };
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast-item ${type}`;
            toast.innerHTML = `
                <i class="bi ${icons[type] || icons.success} toast-icon"></i>
                <span class="toast-msg">${message}</span>
                <button class="toast-close" onclick="this.closest('.toast-item').remove()">
                    <i class="bi bi-x"></i>
                </button>
                <div class="toast-progress"></div>
            `;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 4200);
        }

        // Show server-side toasts
        @if(session('toast_success'))
            showToast(@json(session('toast_success')), 'success');
        @endif
        @if(session('toast_error'))
            showToast(@json(session('toast_error')), 'error');
        @endif
        @if(session('toast_warning'))
            showToast(@json(session('toast_warning')), 'warning');
        @endif
        @if(session('toast_info'))
            showToast(@json(session('toast_info')), 'info');
        @endif

        // Confirm delete helper
        function confirmDelete(formId, name) {
            if (confirm(`Are you sure you want to delete "${name}"? This action cannot be undone.`)) {
                document.getElementById(formId).submit();
            }
        }
    </script>
    @stack('scripts')
</body>
</html>

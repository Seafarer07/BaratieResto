<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — Baratie Resto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i|Cormorant+Garamond:400,600i&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --bg:      #0f0f0f;
            --sidebar: #111111;
            --card:    #1a1a1a;
            --card2:   #1e1e1e;
            --border:  rgba(212,175,55,.15);
            --gold:    #d4af37;
            --gold-dim:rgba(212,175,55,.35);
            --text:    #eaeaea;
            --muted:   #666;
            --danger:  #e07070;
            --success: #6fcf97;
            --sidebar-w: 240px;
            --topbar-h:  62px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Playfair Display', serif;
            margin: 0;
            min-height: 100vh;
        }

        /* ════════ SIDEBAR ════════ */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--sidebar);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform .3s cubic-bezier(.4,0,.2,1);
        }

        .sidebar-brand {
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border-bottom: 1px solid var(--border);
            text-decoration: none;
            flex-shrink: 0;
        }
        .sidebar-brand .brand-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.45rem;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: .15em;
            text-transform: uppercase;
            line-height: 1;
        }
        .sidebar-brand .brand-sub {
            font-size: .5rem;
            letter-spacing: .45em;
            color: var(--gold-dim);
            text-transform: uppercase;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 20px 12px;
        }
        .sidebar-nav::-webkit-scrollbar { width: 3px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: var(--border); border-radius: 2px; }

        .nav-section {
            font-size: .6rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--muted);
            padding: 14px 10px 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: #999;
            font-size: .82rem;
            letter-spacing: .08em;
            text-transform: uppercase;
            transition: background .2s, color .2s;
            margin-bottom: 2px;
        }
        .sidebar-link i { width: 16px; text-align: center; font-size: .9rem; flex-shrink: 0; }
        .sidebar-link:hover { background: rgba(212,175,55,.08); color: var(--text); }
        .sidebar-link.active { background: rgba(212,175,55,.12); color: var(--gold); border-left: 2px solid var(--gold); }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }
        .btn-logout-sidebar {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 10px 14px; border-radius: 8px;
            background: transparent; border: 1px solid rgba(224,112,112,.25);
            color: #999; font-size: .78rem; letter-spacing: .08em;
            text-transform: uppercase; font-family: 'Playfair Display', serif;
            cursor: pointer; transition: .2s;
        }
        .btn-logout-sidebar:hover { border-color: var(--danger); color: var(--danger); }

        /* ════════ TOPBAR ════════ */
        .admin-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: rgba(17,17,17,.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            z-index: 100;
            transition: left .3s;
        }

        .topbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text);
            letter-spacing: .05em;
        }
        .topbar-title span { color: var(--gold); }

        .topbar-right { display: flex; align-items: center; gap: 16px; }
        .topbar-user { display: flex; align-items: center; gap: 10px; }
        .topbar-avatar { width:32px; height:32px; border-radius:50%; object-fit:cover; border:1px solid var(--gold-dim); }
        .topbar-name { font-size: .8rem; color: #aaa; letter-spacing: .06em; }

        .hamburger-top {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px;
        }
        .hamburger-top span { display:block; width:22px; height:1.5px; background:var(--gold); border-radius:2px; transition:.3s; }

        /* ════════ MAIN CONTENT ════════ */
        .admin-main {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            min-height: calc(100vh - var(--topbar-h));
            padding: 28px;
            transition: margin-left .3s;
        }

        /* ════════ SHARED COMPONENTS ════════ */

        /* Page heading */
        .page-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-heading h2 {
            font-size: 1.5rem;
            color: var(--text);
            margin: 0;
        }
        .page-heading h2 span { color: var(--gold); }
        .breadcrumb-bar {
            font-size: .75rem;
            color: var(--muted);
            letter-spacing: .06em;
            margin-top: 3px;
        }
        .breadcrumb-bar a { color: var(--gold-dim); text-decoration: none; }
        .breadcrumb-bar a:hover { color: var(--gold); }

        /* Admin Card */
        .a-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }
        .a-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
        .a-card-header h5 {
            margin: 0;
            font-size: .88rem;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--gold);
        }
        .a-card-body { padding: 22px; }

        /* Stat card */
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 22px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: border-color .25s, transform .2s;
        }
        .stat-card:hover { border-color: var(--gold-dim); transform: translateY(-2px); }
        .stat-card .stat-label { font-size: .72rem; letter-spacing: .15em; text-transform: uppercase; color: var(--muted); margin-bottom: 6px; }
        .stat-card .stat-value { font-size: 2.2rem; font-weight: 700; color: var(--gold); line-height: 1; }
        .stat-card .stat-icon { width:52px; height:52px; border-radius:12px; background:rgba(212,175,55,.1); border:1px solid rgba(212,175,55,.2); display:flex; align-items:center; justify-content:center; }
        .stat-card .stat-icon i { color: var(--gold); font-size: 1.3rem; }

        /* Table */
        .a-table { width: 100%; border-collapse: collapse; }
        .a-table thead th {
            background: rgba(212,175,55,.08);
            color: var(--gold);
            font-size: .72rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }
        .a-table tbody tr { border-bottom: 1px solid rgba(255,255,255,.04); transition: background .15s; }
        .a-table tbody tr:last-child { border-bottom: none; }
        .a-table tbody tr:hover { background: rgba(212,175,55,.04); }
        .a-table tbody td { padding: 13px 16px; font-size: .88rem; color: #ccc; vertical-align: middle; }
        .a-table .td-img { width:52px; height:52px; border-radius:8px; object-fit:cover; border:1px solid rgba(212,175,55,.2); }
        .a-table .td-avatar { width:38px; height:38px; border-radius:50%; object-fit:cover; border:1px solid rgba(212,175,55,.25); }

        /* Buttons */
        .btn-gold { background:linear-gradient(135deg,#d4af37,#b8962e); color:#111; font-weight:700; border:none; border-radius:8px; padding:9px 20px; font-size:.78rem; letter-spacing:.1em; text-transform:uppercase; font-family:'Playfair Display',serif; transition:opacity .2s,transform .15s; text-decoration:none; display:inline-flex; align-items:center; gap:7px; cursor:pointer; }
        .btn-gold:hover { opacity:.88; transform:translateY(-1px); color:#111; }
        .btn-outline-gold { background:transparent; border:1px solid var(--gold-dim); color:var(--gold); border-radius:8px; padding:7px 16px; font-size:.75rem; letter-spacing:.1em; text-transform:uppercase; font-family:'Playfair Display',serif; transition:.2s; text-decoration:none; display:inline-flex; align-items:center; gap:6px; cursor:pointer; }
        .btn-outline-gold:hover { background:var(--gold); color:#111; }
        .btn-danger-sm { background:transparent; border:1px solid rgba(224,112,112,.3); color:#e07070; border-radius:8px; padding:7px 14px; font-size:.75rem; letter-spacing:.08em; text-transform:uppercase; font-family:'Playfair Display',serif; transition:.2s; display:inline-flex; align-items:center; gap:5px; cursor:pointer; }
        .btn-danger-sm:hover { background:rgba(224,112,112,.15); border-color:var(--danger); }

        /* Badges */
        .badge-gold    { background:rgba(212,175,55,.15); color:var(--gold); border:1px solid rgba(212,175,55,.3); border-radius:20px; padding:3px 10px; font-size:.72rem; letter-spacing:.06em; }
        .badge-success { background:rgba(111,207,151,.12); color:#6fcf97; border:1px solid rgba(111,207,151,.25); border-radius:20px; padding:3px 10px; font-size:.72rem; }
        .badge-danger  { background:rgba(224,112,112,.12); color:#e07070; border:1px solid rgba(224,112,112,.25); border-radius:20px; padding:3px 10px; font-size:.72rem; }

        /* Form */
        .f-label { color:#999; font-size:.75rem; letter-spacing:.12em; text-transform:uppercase; margin-bottom:6px; display:block; }
        .f-control { background:#222; border:1px solid #333; color:var(--text); border-radius:8px; padding:11px 14px; width:100%; font-family:'Playfair Display',serif; font-size:.9rem; transition:border-color .2s; }
        .f-control:focus { outline:none; border-color:var(--gold); box-shadow:0 0 0 3px rgba(212,175,55,.12); background:#222; color:var(--text); }
        .f-control::placeholder { color:#444; }
        .f-control option { background:#222; }
        select.f-control { cursor:pointer; }
        textarea.f-control { resize:vertical; min-height:90px; }

        /* Alerts */
        .a-alert { border-radius:10px; padding:12px 18px; font-size:.88rem; margin-bottom:20px; }
        .a-alert-success { background:rgba(30,58,47,.8); border:1px solid #2e7d52; color:#7fffa8; }
        .a-alert-danger   { background:rgba(58,30,30,.8); border:1px solid #7d2e2e; color:#ffb2b2; }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.6);
            z-index: 150;
        }

        /* ════════ RESPONSIVE ════════ */
        @media (max-width: 991px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.open { transform: translateX(0); }
            .admin-topbar { left: 0; }
            .admin-main { margin-left: 0; }
            .hamburger-top { display: flex; }
            .sidebar-overlay.open { display: block; }
        }

        @media (max-width: 575px) {
            .admin-main { padding: 16px; }
            .page-heading h2 { font-size: 1.2rem; }
        }

        /* Pagination override */
        .pagination .page-link { background:var(--card2); border-color:#2a2a2a; color:var(--text); font-family:'Playfair Display',serif; border-radius:6px !important; margin:0 2px; }
        .pagination .page-link:hover { background:var(--gold); border-color:var(--gold); color:#111; }
        .pagination .active .page-link { background:var(--gold); border-color:var(--gold); color:#111; font-weight:700; }
        .pagination .disabled .page-link { background:var(--card); color:var(--muted); }
    </style>
</head>

<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- ═══ SIDEBAR ═══ -->
    <aside class="admin-sidebar" id="adminSidebar">
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <span class="brand-main">Baratie</span>
            <span class="brand-sub">Admin Panel</span>
        </a>

        <nav class="sidebar-nav">
            <p class="nav-section">Main</p>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <p class="nav-section">Manage</p>
            <a href="{{ route('menu.index') }}" class="sidebar-link {{ request()->is('admin/menu*') ? 'active' : '' }}">
                <i class="fa-solid fa-utensils"></i> Menu
            </a>
            <a href="{{ route('meja.index') }}" class="sidebar-link {{ request()->is('admin/meja*') ? 'active' : '' }}">
                <i class="fa-solid fa-chair"></i> Meja
            </a>
            <a href="{{ route('reservasi.index') }}" class="sidebar-link {{ request()->is('admin/reservasi*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar-check"></i> Reservasi
            </a>
            <a href="{{ route('user.index') }}" class="sidebar-link {{ request()->is('admin/user*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Users
            </a>
            <a href="{{ route('review.index') }}" class="sidebar-link {{ request()->is('admin/review*') ? 'active' : '' }}">
                <i class="fa-solid fa-star"></i> Reviews
            </a>

            <p class="nav-section">Site</p>
            <a href="{{ url('web/home') }}" class="sidebar-link" target="_blank">
                <i class="fa-solid fa-arrow-up-right-from-square"></i> View Website
            </a>
        </nav>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST" style="margin:0">
                @csrf
                <button type="submit" class="btn-logout-sidebar">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══ TOPBAR ═══ -->
    <header class="admin-topbar">
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="hamburger-top" onclick="toggleSidebar()" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
            <div>
                <div class="topbar-title">@yield('page-title', '<span>Dashboard</span>')</div>
            </div>
        </div>
        <div class="topbar-right">
            @auth
            <div class="topbar-user">
                @php
                    $avatarPath = Auth::user()->gambar;
                    $avatarUrl = ($avatarPath && file_exists(public_path($avatarPath)))
                        ? asset($avatarPath)
                        : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama_pelanggan) . '&background=d4af37&color=111&size=64';
                @endphp
                <img src="{{ $avatarUrl }}" class="topbar-avatar" alt="avatar">
                <span class="topbar-name d-none d-sm-inline">{{ Auth::user()->nama_pelanggan }}</span>
            </div>
            @endauth
        </div>
    </header>

    <!-- ═══ MAIN CONTENT ═══ -->
    <main class="admin-main">
        @if(session('success'))
            <div class="a-alert a-alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="a-alert a-alert-danger">{{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</body>

<script>
    function toggleSidebar() {
        document.getElementById('adminSidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('open');
    }
    function closeSidebar() {
        document.getElementById('adminSidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.remove('open');
    }
</script>
</html>

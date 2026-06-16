<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Baratie Resto')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i|Cormorant+Garamond:300,400,600i&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* ════════════════════════════════
           BASE
        ════════════════════════════════ */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            background-color: #1a1a1a;
            font-family: 'Playfair Display', serif;
            color: #eaeaea;
            margin: 0; padding: 0;
            display: flex; flex-direction: column; min-height: 100vh;
            padding-top: 72px; /* offset untuk fixed navbar */
        }

        /* ════════════════════════════════
           NAVBAR
        ════════════════════════════════ */
        .navbar-luxury {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            height: 72px;
            background-color: rgba(10, 10, 10, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
            transition: background-color .3s, border-color .3s, box-shadow .3s;
            display: flex;
            align-items: center;
        }

        /* Scrolled state */
        .navbar-luxury.scrolled {
            background-color: rgba(8, 8, 8, 0.98);
            border-bottom-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.5);
        }

        .navbar-inner {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        /* ── Brand ── */
        .brand {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            line-height: 1;
            flex-shrink: 0;
        }
        .brand-main {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.7rem;
            font-weight: 600;
            color: #d4af37;
            letter-spacing: .12em;
            text-transform: uppercase;
        }
        .brand-sub {
            font-size: .52rem;
            letter-spacing: .4em;
            color: rgba(212,175,55,.55);
            text-transform: uppercase;
            margin-top: 1px;
        }

        /* ── Desktop Nav Links ── */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0; padding: 0;
        }
        .nav-links .nav-link {
            font-size: .78rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #bbb !important;
            padding: 6px 14px;
            border-radius: 4px;
            position: relative;
            text-decoration: none;
            transition: color .2s;
            white-space: nowrap;
        }
        .nav-links .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0; left: 50%; right: 50%;
            height: 1px;
            background: #d4af37;
            transition: left .25s, right .25s;
        }
        .nav-links .nav-link:hover,
        .nav-links .nav-link.active-link {
            color: #fff !important;
        }
        .nav-links .nav-link:hover::after,
        .nav-links .nav-link.active-link::after {
            left: 14px; right: 14px;
        }

        /* ── Reservation CTA ── */
        .btn-reserve {
            font-size: .72rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #d4af37 !important;
            border: 1px solid rgba(212,175,55,.5);
            padding: 7px 18px;
            border-radius: 4px;
            text-decoration: none;
            transition: background .2s, border-color .2s, color .2s;
            white-space: nowrap;
        }
        .btn-reserve:hover {
            background: #d4af37;
            border-color: #d4af37;
            color: #111 !important;
        }

        /* ── User Icon / Login ── */
        .nav-profile {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .nav-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid rgba(212,175,55,.4);
            transition: border-color .2s;
        }
        .nav-avatar:hover { border-color: #d4af37; }
        .nav-user-link {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #bbb;
            font-size: .78rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            transition: color .2s;
        }
        .nav-user-link:hover { color: #d4af37; }
        .btn-login {
            font-size: .72rem;
            letter-spacing: .18em;
            text-transform: uppercase;
            background: #d4af37;
            color: #111 !important;
            border: none;
            padding: 7px 18px;
            border-radius: 4px;
            text-decoration: none;
            transition: opacity .2s;
            white-space: nowrap;
            font-weight: 700;
        }
        .btn-login:hover { opacity: .85; }

        /* ── Gold Divider (between links and CTA) ── */
        .nav-sep {
            width: 1px; height: 20px;
            background: rgba(212,175,55,.2);
            flex-shrink: 0;
        }

        /* ── Hamburger ── */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 4px;
            z-index: 1100;
        }
        .hamburger span {
            display: block;
            width: 24px; height: 1.5px;
            background: #d4af37;
            border-radius: 2px;
            transition: transform .3s, opacity .3s;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

        /* ════════════════════════════════
           MOBILE DRAWER
        ════════════════════════════════ */
        .mobile-drawer {
            position: fixed;
            top: 72px; left: 0; right: 0; bottom: 0;
            background: rgba(8, 8, 8, 0.98);
            backdrop-filter: blur(20px);
            z-index: 999;
            display: flex;
            flex-direction: column;
            padding: 32px 28px 40px;
            transform: translateX(100%);
            transition: transform .35s cubic-bezier(.4,0,.2,1);
            overflow-y: auto;
        }
        .mobile-drawer.open { transform: translateX(0); }

        .drawer-brand {
            text-align: center;
            margin-bottom: 32px;
            padding-bottom: 24px;
            border-bottom: 1px solid rgba(212,175,55,.15);
        }
        .drawer-brand span {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #d4af37;
            letter-spacing: .15em;
            text-transform: uppercase;
        }
        .drawer-brand small {
            display: block;
            font-size: .55rem;
            letter-spacing: .45em;
            color: rgba(212,175,55,.45);
            text-transform: uppercase;
            margin-top: 2px;
        }

        .drawer-links {
            list-style: none; margin: 0; padding: 0;
            display: flex; flex-direction: column; gap: 4px;
            flex: 1;
        }
        .drawer-links a {
            display: block;
            padding: 14px 12px;
            font-size: .88rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: #aaa;
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.04);
            transition: color .2s, padding-left .2s;
        }
        .drawer-links a:hover,
        .drawer-links a.active-link {
            color: #d4af37;
            padding-left: 20px;
        }

        .drawer-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 28px;
            padding-top: 24px;
            border-top: 1px solid rgba(212,175,55,.15);
        }
        .drawer-btn {
            display: block; text-align: center; text-decoration: none;
            padding: 13px; border-radius: 8px;
            font-size: .78rem; letter-spacing: .18em; text-transform: uppercase;
            font-family: 'Playfair Display', serif; transition: .2s;
        }
        .drawer-btn-gold {
            background: linear-gradient(135deg, #d4af37, #b8962e);
            color: #111; font-weight: 700;
        }
        .drawer-btn-outline {
            border: 1px solid rgba(212,175,55,.35);
            color: #d4af37;
        }
        .drawer-btn-outline:hover { background: #d4af37; color: #111; }

        /* ── User info in drawer ── */
        .drawer-user {
            display: flex; align-items: center; gap: 14px;
            padding: 16px 12px;
            background: rgba(212,175,55,.05);
            border: 1px solid rgba(212,175,55,.12);
            border-radius: 10px;
            margin-bottom: 8px;
        }
        .drawer-user img { width:44px; height:44px; border-radius:50%; object-fit:cover; border:1px solid rgba(212,175,55,.35); }
        .drawer-user .uname { color: #fff; font-size: .9rem; }
        .drawer-user .uemail { color: #666; font-size: .75rem; }

        /* ════════════════════════════════
           RESPONSIVE BREAKPOINTS
        ════════════════════════════════ */
        @media (max-width: 991px) {
            .nav-links, .nav-sep, .btn-reserve, .nav-profile { display: none; }
            .hamburger { display: flex; }
        }

        /* ════════════════════════════════
           FOOTER
        ════════════════════════════════ */
        footer {
            background-color: #0d0d0d;
            border-top: 1px solid rgba(212,175,55,.12);
            color: #666;
            margin-top: auto;
            font-size: .88rem;
        }
        footer .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.4rem; color: #d4af37; letter-spacing: .12em;
        }
        footer a { color: #666; text-decoration: none; transition: color .2s; }
        footer a:hover { color: #d4af37; }
        footer .footer-heading { color: #eaeaea; font-size: .8rem; letter-spacing: .2em; text-transform: uppercase; margin-bottom: 14px; }
        footer .footer-divider { border-color: rgba(212,175,55,.12); }
        footer .social-link {
            width: 36px; height: 36px;
            border: 1px solid rgba(212,175,55,.2);
            border-radius: 50%;
            display: inline-flex; align-items: center; justify-content: center;
            color: #666; font-size: .85rem; transition: .2s;
        }
        footer .social-link:hover { border-color: #d4af37; color: #d4af37; }
    </style>
</head>

<body>

    {{-- ════════════════════════════════
         NAVBAR
    ════════════════════════════════ --}}
    <nav class="navbar-luxury" id="navbar">
        <div class="navbar-inner">

            {{-- Brand --}}
            <a class="brand" href="{{ url('web/home') }}">
                <span class="brand-main">Baratie</span>
                <span class="brand-sub">Ristorante</span>
            </a>

            {{-- Desktop Links --}}
            <ul class="nav-links">
                <li><a class="nav-link" href="{{ url('web/home') }}">Home</a></li>
                <li><a class="nav-link" href="{{ url('web/menu') }}">Menu</a></li>
                <li><a class="nav-link" href="{{ url('web/about') }}">About</a></li>
                <li><a class="nav-link" href="{{ url('web/review') }}">Reviews</a></li>
            </ul>

            {{-- Desktop Right --}}
            <div style="display:flex;align-items:center;gap:14px;">
                <a href="{{ url('web/reservation') }}" class="btn-reserve">Reserve a Table</a>
                <div class="nav-sep"></div>
                @auth
                    @php
                        $navAv = Auth::user()->gambar && file_exists(public_path(Auth::user()->gambar))
                            ? asset(Auth::user()->gambar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama_pelanggan) . '&background=d4af37&color=111&size=64';
                    @endphp
                    <a href="{{ url('web/profile') }}" class="nav-user-link">
                        <img src="{{ $navAv }}" alt="avatar" class="nav-avatar">
                    </a>
                @else
                    <a href="{{ url('web/login') }}" class="btn-login">Login</a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <button class="hamburger" id="hamburger" aria-label="Menu" onclick="toggleDrawer()">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    {{-- ════════════════════════════════
         MOBILE DRAWER
    ════════════════════════════════ --}}
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="drawer-brand">
            <span>Baratie</span>
            <small>Ristorante</small>
        </div>

        @auth
        <div class="drawer-user">
            <img src="{{ $navAv }}" alt="avatar">
            <div>
                <div class="uname">{{ Auth::user()->nama_pelanggan }}</div>
                <div class="uemail">{{ Auth::user()->email }}</div>
            </div>
        </div>
        @endauth

        <ul class="drawer-links">
            <li><a href="{{ url('web/home') }}">Home</a></li>
            <li><a href="{{ url('web/menu') }}">Menu</a></li>
            <li><a href="{{ url('web/about') }}">About</a></li>
            <li><a href="{{ url('web/review') }}">Reviews</a></li>
            @auth
            <li><a href="{{ url('web/profile') }}">My Profile</a></li>
            @endauth
        </ul>

        <div class="drawer-actions">
            <a href="{{ url('web/reservation') }}" class="drawer-btn drawer-btn-gold">Reserve a Table</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="drawer-btn drawer-btn-outline" style="width:100%;cursor:pointer;">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ url('web/login') }}" class="drawer-btn drawer-btn-outline">Login</a>
            @endauth
        </div>
    </div>

    {{-- Page Content --}}
    @yield('content')

    {{-- ════════════════════════════════
         FOOTER
    ════════════════════════════════ --}}
    <footer class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <p class="footer-brand mb-2">Baratie Resto</p>
                    <p style="color:#555;font-size:.85rem;line-height:1.7;max-width:280px;">
                        A culinary haven where tradition meets innovation. Every dish tells a story.
                    </p>
                    <div class="d-flex gap-2 mt-3">
                        <a href="#" class="social-link"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <p class="footer-heading">Explore</p>
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <a href="{{ url('web/home') }}">Home</a>
                        <a href="{{ url('web/menu') }}">Menu</a>
                        <a href="{{ url('web/about') }}">About</a>
                        <a href="{{ url('web/review') }}">Reviews</a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-6">
                    <p class="footer-heading">Services</p>
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <a href="{{ url('web/reservation') }}">Reservation</a>
                        <a href="{{ url('web/menu') }}">Our Menu</a>
                        <a href="{{ url('web/review') }}">Leave a Review</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <p class="footer-heading">Contact</p>
                    <div style="display:flex;flex-direction:column;gap:10px;">
                        <span style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid fa-location-dot" style="color:#d4af37;width:14px;"></i>
                            Yogyakarta, Indonesia
                        </span>
                        <span style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid fa-envelope" style="color:#d4af37;width:14px;"></i>
                            baratieresto@example.com
                        </span>
                        <span style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-solid fa-phone" style="color:#d4af37;width:14px;"></i>
                            +62 1234 5678
                        </span>
                        <span style="display:flex;align-items:center;gap:10px;">
                            <i class="fa-regular fa-clock" style="color:#d4af37;width:14px;"></i>
                            Mon–Fri 08.00–22.00 · Sat–Sun 09.00–23.00
                        </span>
                    </div>
                </div>
            </div>

            <hr class="footer-divider my-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2"
                 style="font-size:.75rem;letter-spacing:.08em;">
                <span>© {{ date('Y') }} Baratie Resto. All rights reserved.</span>
                <span style="color:rgba(212,175,55,.4);letter-spacing:.2em;text-transform:uppercase;font-size:.65rem;">
                    Fine Dining · Yogyakarta
                </span>
            </div>
        </div>
    </footer>

    <script>
        // ── Drawer toggle ──
        function toggleDrawer() {
            const drawer     = document.getElementById('mobileDrawer');
            const hamburger  = document.getElementById('hamburger');
            const isOpen     = drawer.classList.toggle('open');
            hamburger.classList.toggle('open', isOpen);
            document.body.style.overflow = isOpen ? 'hidden' : '';
        }

        // Close drawer on link click
        document.querySelectorAll('.drawer-links a, .drawer-actions a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobileDrawer').classList.remove('open');
                document.getElementById('hamburger').classList.remove('open');
                document.body.style.overflow = '';
            });
        });

        // ── Navbar scroll effect ──
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 40);
        }, { passive: true });

        // ── Active link highlight ──
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-links .nav-link, .drawer-links a').forEach(link => {
            if (link.getAttribute('href') && currentPath.includes(link.getAttribute('href').replace(window.location.origin, ''))) {
                link.classList.add('active-link');
            }
        });
    </script>
</body>
</html>

@extends('web.layout.nav')
@section('title', 'Reservation — Baratie Resto')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i&display=swap" rel="stylesheet">

<style>
    body { background-color: #1a1a1a; font-family: 'Playfair Display', serif; color: #eaeaea; }

    .eyebrow { letter-spacing:.35em; font-size:.78rem; color:#d4af37; text-transform:uppercase; margin-bottom:10px; }
    .gold-divider { display:flex; align-items:center; justify-content:center; gap:12px; margin:14px auto 0; }
    .gold-divider span { display:block; height:1px; width:80px; background:#d4af37; opacity:.5; }
    .gold-divider i { color:#d4af37; font-size:.7rem; }

    /* ── Page Header ── */
    .page-header { text-align:center; padding:60px 0 50px; }
    .page-header h1 { font-size:2.8rem; font-weight:700; color:#fff; margin-bottom:14px; }
    .page-header .lead { color:#888; font-size:.95rem; max-width:520px; margin:10px auto 0; }

    /* ── Layout ── */
    .reservation-grid {
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 36px;
        align-items: start;
        padding-bottom: 60px;
    }
    @media (max-width: 991px) { .reservation-grid { grid-template-columns: 1fr; } }

    /* ── Form Panel ── */
    .form-panel {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.25);
        border-radius: 16px;
        padding: 36px 32px;
    }
    .form-panel h4 {
        color: #d4af37; font-size:1.1rem; letter-spacing:.1em;
        text-transform:uppercase; margin-bottom:24px;
        padding-bottom:14px; border-bottom:1px solid rgba(212,175,55,.2);
    }

    /* ── Form Controls ── */
    .form-label { color:#aaa; font-size:.82rem; letter-spacing:.08em; text-transform:uppercase; margin-bottom:6px; }
    .form-control, .form-select {
        background-color:#2a2a2a; border:1px solid #3a3a3a;
        color:#eaeaea; border-radius:8px; padding:11px 14px;
        font-family:'Playfair Display',serif; transition:border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        background-color:#2a2a2a; border-color:#d4af37; color:#eaeaea;
        box-shadow:0 0 0 3px rgba(212,175,55,.15);
    }
    .form-control::placeholder { color:#555; }
    .form-control[readonly] { opacity:.6; cursor:not-allowed; }
    .form-select option { background-color:#2a2a2a; }

    /* ── Buttons ── */
    .btn-gold {
        background: linear-gradient(135deg, #d4af37, #b8962e);
        color:#111; font-weight:700; letter-spacing:.1em;
        text-transform:uppercase; font-size:.82rem;
        border:none; border-radius:8px; padding:13px 24px;
        width:100%; transition:opacity .2s, transform .15s;
        font-family:'Playfair Display',serif;
    }
    .btn-gold:hover { opacity:.88; transform:translateY(-1px); }
    .btn-gold-outline {
        display:block; text-align:center; text-decoration:none;
        border:1px solid #d4af37; color:#d4af37; background:transparent;
        border-radius:8px; padding:13px 24px; width:100%;
        font-size:.82rem; letter-spacing:.1em; text-transform:uppercase;
        font-family:'Playfair Display',serif; transition:.2s;
    }
    .btn-gold-outline:hover { background:#d4af37; color:#111; }

    /* ── Alerts ── */
    .alert-luxury { border-radius:10px; padding:12px 18px; font-size:.9rem; margin-bottom:20px; }
    .alert-success-luxury { background:rgba(30,58,47,.8); border:1px solid #2e7d52; color:#7fffa8; }
    .alert-error-luxury   { background:rgba(58,30,30,.8); border:1px solid #7d2e2e; color:#ffb2b2; }

    /* ── Info Panel ── */
    .info-panel { position: sticky; top: 90px; }

    .info-card {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .info-card img { width:100%; height:200px; object-fit:cover; display:block; }
    .info-card-body { padding:22px 20px; }
    .info-card-body h5 { color:#fff; margin-bottom:14px; font-size:1.05rem; }

    .info-item {
        display:flex; align-items:flex-start; gap:14px;
        padding: 12px 0; border-bottom:1px solid #252525;
    }
    .info-item:last-child { border-bottom:none; }
    .info-item .icon {
        width:36px; height:36px; flex-shrink:0;
        background:rgba(212,175,55,.1); border:1px solid rgba(212,175,55,.25);
        border-radius:8px; display:flex; align-items:center; justify-content:center;
    }
    .info-item .icon i { color:#d4af37; font-size:.9rem; }
    .info-item .text strong { display:block; color:#fff; font-size:.88rem; margin-bottom:2px; }
    .info-item .text span  { color:#777; font-size:.8rem; }

    /* table type badges */
    .table-badges { display:flex; flex-wrap:wrap; gap:8px; margin-top:4px; }
    .table-badge {
        padding:4px 12px; border-radius:20px; font-size:.75rem;
        border:1px solid rgba(212,175,55,.3); color:#d4af37;
        letter-spacing:.05em;
    }
</style>

{{-- Page Header --}}
<div class="page-header" data-aos="fade-down">
    <p class="eyebrow">Baratie Resto</p>
    <h1>Make a Reservation</h1>
    <p class="lead">Reserve your table and let us prepare an unforgettable evening for you.</p>
    <div class="gold-divider"><span></span><i class="fa fa-calendar"></i><span></span></div>
</div>

<div class="container">
    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert-luxury alert-success-luxury">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-luxury alert-error-luxury">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-luxury alert-error-luxury">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="reservation-grid">

        {{-- ── Form ── --}}
        <div data-aos="fade-right">
            <div class="form-panel">
                <h4>Reservation Details</h4>

                <form action="{{ route('web.reservation.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control"
                               value="{{ Auth::check() ? Auth::user()->nama_pelanggan : '' }}"
                               placeholder="Your name" readonly>
                        <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" class="form-control"
                               value="{{ Auth::check() ? Auth::user()->telepon : '' }}"
                               placeholder="Phone number" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="tableSelect" class="form-label">Table Type <span style="color:#d4af37">*</span></label>
                        <select class="form-select" id="tableSelect" name="jenis" required>
                            <option value="" disabled {{ old('jenis') ? '' : 'selected' }}>— Choose a table —</option>
                            <option value="Reguler" {{ old('jenis') == 'Reguler' ? 'selected' : '' }}>Reguler — 2 seats</option>
                            <option value="VIP"     {{ old('jenis') == 'VIP'     ? 'selected' : '' }}>VIP — 4 seats</option>
                            <option value="VVIP"    {{ old('jenis') == 'VVIP'    ? 'selected' : '' }}>VVIP — 8 seats</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dateInput" class="form-label">Date <span style="color:#d4af37">*</span></label>
                        <input type="date" class="form-control" id="dateInput" name="tanggal_reservasi"
                               value="{{ old('tanggal_reservasi') }}"
                               min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="noteInput" class="form-label">Special Request</label>
                        <textarea class="form-control" id="noteInput" name="note" rows="3"
                                  placeholder="Allergies, celebrations, seating preferences…">{{ old('note') }}</textarea>
                    </div>

                    @auth
                        <button type="submit" class="btn-gold">Confirm Reservation</button>
                    @else
                        <a href="{{ route('web.login') }}" class="btn-gold-outline">Login to Reserve</a>
                    @endauth
                </form>
            </div>
        </div>

        {{-- ── Info Panel ── --}}
        <div class="info-panel" data-aos="fade-left">
            <div class="info-card">
                <img src="{{ asset('public/images/open.jpg') }}" alt="Baratie Resto">
                <div class="info-card-body">
                    <h5>Visiting Information</h5>

                    <div class="info-item">
                        <div class="icon"><i class="fa fa-clock-o"></i></div>
                        <div class="text">
                            <strong>Opening Hours</strong>
                            <span>Mon–Fri: 08.00 – 22.00</span><br>
                            <span>Sat–Sun: 09.00 – 23.00</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                        <div class="text">
                            <strong>Location</strong>
                            <span>Yogyakarta, Indonesia</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon"><i class="fa fa-phone"></i></div>
                        <div class="text">
                            <strong>Contact</strong>
                            <span>+62 1234 5678</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="icon"><i class="fa fa-table"></i></div>
                        <div class="text">
                            <strong>Table Types</strong>
                            <div class="table-badges">
                                <span class="table-badge">Reguler · 2 seats</span>
                                <span class="table-badge">VIP · 4 seats</span>
                                <span class="table-badge">VVIP · 8 seats</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 650, once: true });

    // Style native date input agar teks tidak hilang di dark mode
    const dateInput = document.getElementById('dateInput');
    if (dateInput) {
        dateInput.style.colorScheme = 'dark';
    }
</script>

@endsection

@extends('web.layout.nav')
@section('title', 'Profile — Baratie Resto')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i&display=swap" rel="stylesheet">

<style>
    body { background-color:#1a1a1a; font-family:'Playfair Display',serif; color:#eaeaea; }

    .eyebrow { letter-spacing:.35em; font-size:.78rem; color:#d4af37; text-transform:uppercase; margin-bottom:10px; }
    .gold-divider { display:flex; align-items:center; justify-content:center; gap:12px; margin:14px auto 0; }
    .gold-divider span { display:block; height:1px; width:80px; background:#d4af37; opacity:.5; }
    .gold-divider i { color:#d4af37; font-size:.7rem; }

    /* ── Page Header ── */
    .page-header { text-align:center; padding:60px 0 50px; }
    .page-header h1 { font-size:2.8rem; font-weight:700; color:#fff; margin-bottom:14px; }

    /* ── Layout ── */
    .profile-grid {
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 28px;
        align-items: start;
        padding-bottom: 60px;
    }
    @media (max-width: 767px) { .profile-grid { grid-template-columns: 1fr; } }

    /* ── Left Card ── */
    .profile-card {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 16px;
        padding: 32px 24px;
        text-align: center;
        position: sticky;
        top: 90px;
    }
    .avatar-wrap {
        position: relative;
        width: 130px; height: 130px;
        margin: 0 auto 20px;
        cursor: pointer;
    }
    .avatar-wrap img {
        width: 130px; height: 130px;
        border-radius: 50%; object-fit: cover;
        border: 3px solid rgba(212,175,55,.5);
        display: block;
        transition: border-color .25s;
    }
    .avatar-wrap:hover img { border-color: #d4af37; }
    .avatar-overlay {
        position: absolute; inset: 0;
        border-radius: 50%;
        background: rgba(0,0,0,.45);
        display: flex; align-items: center; justify-content: center;
        opacity: 0; transition: opacity .2s;
    }
    .avatar-wrap:hover .avatar-overlay { opacity: 1; }
    .avatar-overlay i { color: #d4af37; font-size: 1.2rem; }

    .profile-card h5 { color: #fff; font-size: 1.15rem; margin-bottom: 4px; }
    .profile-card .email { color: #777; font-size: .82rem; margin-bottom: 24px; }

    .info-row {
        display: flex; justify-content: space-between; align-items: center;
        padding: 10px 0; border-bottom: 1px solid #252525;
        text-align: left;
    }
    .info-row:last-of-type { border-bottom: none; margin-bottom: 20px; }
    .info-row .label { color: #666; font-size: .78rem; letter-spacing: .06em; text-transform: uppercase; }
    .info-row .value { color: #eaeaea; font-size: .88rem; text-align: right; max-width: 60%; word-break: break-word; }

    .btn-logout {
        width: 100%; background: transparent;
        border: 1px solid rgba(255,255,255,.15);
        color: #888; border-radius: 8px;
        padding: 10px; font-family: 'Playfair Display', serif;
        font-size: .82rem; letter-spacing: .08em; text-transform: uppercase;
        transition: .2s; cursor: pointer;
    }
    .btn-logout:hover { border-color: #e07070; color: #e07070; }

    /* ── Right / Edit Panel ── */
    .edit-panel {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 16px;
        padding: 36px 32px;
    }
    .edit-panel h4 {
        color: #d4af37; font-size: 1.1rem; letter-spacing: .1em;
        text-transform: uppercase; margin-bottom: 24px;
        padding-bottom: 14px; border-bottom: 1px solid rgba(212,175,55,.2);
    }

    /* ── Form Controls ── */
    .form-label { color: #aaa; font-size: .82rem; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 6px; }
    .form-control {
        background-color: #2a2a2a; border: 1px solid #3a3a3a;
        color: #eaeaea; border-radius: 8px; padding: 11px 14px;
        font-family: 'Playfair Display', serif; transition: border-color .2s;
    }
    .form-control:focus {
        background-color: #2a2a2a; border-color: #d4af37; color: #eaeaea;
        box-shadow: 0 0 0 3px rgba(212,175,55,.15);
    }
    .form-control::placeholder { color: #555; }

    /* ── Buttons ── */
    .btn-gold {
        background: linear-gradient(135deg, #d4af37, #b8962e);
        color: #111; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; font-size: .82rem;
        border: none; border-radius: 8px; padding: 12px 24px;
        transition: opacity .2s, transform .15s;
        font-family: 'Playfair Display', serif;
    }
    .btn-gold:hover { opacity: .88; transform: translateY(-1px); }
    .btn-outline-cancel {
        background: transparent; border: 1px solid #3a3a3a; color: #888;
        border-radius: 8px; padding: 12px 24px;
        font-family: 'Playfair Display', serif; font-size: .82rem;
        letter-spacing: .08em; text-transform: uppercase; transition: .2s;
    }
    .btn-outline-cancel:hover { border-color: #555; color: #eaeaea; }

    /* ── Alerts ── */
    .alert-luxury { border-radius: 10px; padding: 12px 18px; font-size: .9rem; margin-bottom: 20px; }
    .alert-success-luxury { background: rgba(30,58,47,.8); border: 1px solid #2e7d52; color: #7fffa8; }
    .alert-error-luxury   { background: rgba(58,30,30,.8); border: 1px solid #7d2e2e; color: #ffb2b2; }

    /* ── Section divider in form ── */
    .form-section-label {
        font-size: .72rem; letter-spacing: .15em; text-transform: uppercase;
        color: #555; margin: 24px 0 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-section-label::before, .form-section-label::after {
        content: ''; flex: 1; height: 1px; background: #2a2a2a;
    }
</style>

{{-- Page Header --}}
<div class="page-header" data-aos="fade-down">
    <p class="eyebrow">Baratie Resto</p>
    <h1>My Profile</h1>
    <div class="gold-divider"><span></span><i class="fa fa-user"></i><span></span></div>
</div>

<div class="container">

    @if(isset($user) && $user->id)

    <div class="profile-grid">

        {{-- ── Left Card ── --}}
        <div data-aos="fade-right">
            <div class="profile-card">

                {{-- Avatar (klik untuk ganti) --}}
                <div class="avatar-wrap" onclick="document.getElementById('gambar').click()" title="Klik untuk ganti foto">
                    <img id="foto-kiri" src="{{ asset($user->gambar) }}" alt="Foto Profil">
                    <div class="avatar-overlay"><i class="fa fa-camera"></i></div>
                </div>

                <h5>{{ $user->nama_pelanggan }}</h5>
                <p class="email">{{ $user->email }}</p>

                <div class="info-row">
                    <span class="label">Telepon</span>
                    <span class="value">{{ $user->telepon }}</span>
                </div>
                <div class="info-row">
                    <span class="label">Member since</span>
                    <span class="value">{{ $user->created_at->format('M Y') }}</span>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fa fa-sign-out me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- ── Edit Panel ── --}}
        <div data-aos="fade-left">

            {{-- Alerts --}}
            @if(session('success'))
                <div class="alert-luxury alert-success-luxury">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-luxury alert-error-luxury">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <div class="edit-panel">
                <h4>Edit Profile</h4>

                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Hidden file input (dipicu dari avatar kiri) --}}
                    <input type="file" id="gambar" name="gambar" accept="image/*"
                           style="display:none;" onchange="previewFoto(event)">
                    @error('gambar')
                        <p class="text-danger" style="font-size:.82rem;margin-top:4px;">{{ $message }}</p>
                    @enderror

                    <div class="form-section-label">Personal Information</div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span style="color:#d4af37">*</span></label>
                        <input type="text" class="form-control" name="nama_pelanggan"
                               value="{{ old('nama_pelanggan', $user->nama_pelanggan) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email <span style="color:#d4af37">*</span></label>
                        <input type="email" class="form-control" name="email"
                               value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nomor Telepon <span style="color:#d4af37">*</span></label>
                        <input type="tel" class="form-control" name="telepon"
                               value="{{ old('telepon', $user->telepon) }}" required>
                    </div>

                    <div class="form-section-label">Change Password <span style="font-size:.7rem;">(kosongkan jika tidak ingin ubah)</span></div>

                    <div class="mb-4">
                        <label class="form-label">Password Baru</label>
                        <input type="password" class="form-control" name="password"
                               placeholder="Minimal 8 karakter" autocomplete="new-password">
                    </div>

                    <div class="d-flex gap-3 justify-content-end">
                        <button type="reset" class="btn-outline-cancel"
                                onclick="document.getElementById('foto-kiri').src='{{ asset($user->gambar) }}';
                                         document.getElementById('preview-foto-hint').style.display='none';">
                            Cancel
                        </button>
                        <button type="submit" class="btn-gold">Save Changes</button>
                    </div>
                </form>
            </div>

            {{-- Foto preview hint --}}
            <p id="preview-foto-hint" style="display:none;text-align:right;color:#666;font-size:.78rem;margin-top:8px;">
                <i class="fa fa-info-circle"></i> Foto baru dipilih — klik Save Changes untuk menyimpan
            </p>

        </div>
    </div>

    @else
        <p class="text-center py-5" style="color:#666;">User tidak ditemukan. Pastikan Anda sudah login.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 650, once: true });

    function previewFoto(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('foto-kiri').src = e.target.result;
            document.getElementById('preview-foto-hint').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>

@endsection

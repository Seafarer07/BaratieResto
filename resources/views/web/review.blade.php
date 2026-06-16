@extends('web.layout.nav')
@section('title', 'Review — Baratie Resto')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i&display=swap" rel="stylesheet">

<style>
    /* ── Base ── */
    body { background-color: #1a1a1a; font-family: 'Playfair Display', serif; color: #eaeaea; }

    /* ── Page Header ── */
    .page-header {
        text-align: center;
        padding: 60px 0 40px;
    }
    .page-header .eyebrow {
        letter-spacing: 0.35em;
        font-size: 0.78rem;
        color: #d4af37;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .page-header h1 {
        font-size: 2.8rem;
        font-weight: 700;
        color: #fff;
        margin-bottom: 16px;
    }
    .gold-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: 0 auto 40px;
    }
    .gold-divider span { display: block; height: 1px; width: 80px; background: #d4af37; opacity: .6; }
    .gold-divider i { color: #d4af37; font-size: 0.7rem; }

    /* ── Layout ── */
    .review-layout {
        display: grid;
        grid-template-columns: 1fr 1.6fr;
        gap: 32px;
        align-items: start;
    }
    @media (max-width: 991px) {
        .review-layout { grid-template-columns: 1fr; }
    }

    /* ── Form Panel ── */
    .form-panel {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.25);
        border-radius: 16px;
        padding: 32px 28px;
        position: sticky;
        top: 90px;
    }
    .form-panel h4 {
        color: #d4af37;
        font-size: 1.2rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 24px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(212,175,55,.2);
    }

    /* ── Form Controls ── */
    .form-label { color: #aaa; font-size: 0.82rem; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 6px; }
    .form-control, .form-select {
        background-color: #2a2a2a;
        border: 1px solid #3a3a3a;
        color: #eaeaea;
        border-radius: 8px;
        padding: 10px 14px;
        font-family: 'Playfair Display', serif;
        transition: border-color .2s;
    }
    .form-control:focus, .form-select:focus {
        background-color: #2a2a2a;
        border-color: #d4af37;
        color: #eaeaea;
        box-shadow: 0 0 0 3px rgba(212,175,55,.15);
    }
    .form-control::placeholder { color: #555; }
    .form-select option { background-color: #2a2a2a; }

    /* ── Star Rating ── */
    .star-group { display: flex; gap: 6px; flex-direction: row-reverse; justify-content: flex-end; }
    .star-group input { display: none; }
    .star-group label {
        font-size: 1.9rem;
        color: #444;
        cursor: pointer;
        transition: color .15s, transform .15s;
        line-height: 1;
    }
    .star-group label:hover,
    .star-group label:hover ~ label,
    .star-group input:checked ~ label { color: #d4af37; }
    .star-group label:hover { transform: scale(1.15); }

    /* ── Submit Button ── */
    .btn-gold {
        background: linear-gradient(135deg, #d4af37, #b8962e);
        color: #111;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-size: 0.82rem;
        border: none;
        border-radius: 8px;
        padding: 12px 24px;
        width: 100%;
        transition: opacity .2s, transform .15s;
        font-family: 'Playfair Display', serif;
    }
    .btn-gold:hover { opacity: .88; transform: translateY(-1px); }

    /* ── Review Cards ── */
    .reviews-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }
    .reviews-header h4 {
        color: #d4af37;
        font-size: 1.1rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin: 0;
    }
    .reviews-count {
        font-size: 0.8rem;
        color: #777;
        letter-spacing: 0.06em;
    }

    .card-review {
        background: linear-gradient(145deg, #232323, #1f1f1f);
        border: 1px solid rgba(212,175,55,.18);
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 16px;
        transition: border-color .25s, transform .2s;
    }
    .card-review:hover {
        border-color: rgba(212,175,55,.5);
        transform: translateY(-2px);
    }

    .reviewer-avatar {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(212,175,55,.4);
        flex-shrink: 0;
    }
    .reviewer-name { font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 1px; }
    .review-date { font-size: 0.75rem; color: #666; letter-spacing: 0.04em; }

    .menu-badge {
        display: inline-block;
        background: rgba(212,175,55,.12);
        border: 1px solid rgba(212,175,55,.25);
        color: #d4af37;
        font-size: 0.78rem;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: 0.05em;
        margin-bottom: 10px;
    }

    .stars-display { display: flex; gap: 3px; }
    .star-filled { color: #d4af37; font-size: 1rem; }
    .star-empty  { color: #3a3a3a; font-size: 1rem; }

    .review-note {
        color: #ccc;
        font-size: 0.95rem;
        line-height: 1.65;
        margin: 10px 0 0;
        font-style: italic;
    }
    .review-note::before { content: '"'; color: #d4af37; font-size: 1.2rem; margin-right: 2px; }
    .review-note::after  { content: '"'; color: #d4af37; font-size: 1.2rem; margin-left: 2px; }

    /* ── Action Buttons ── */
    .review-actions { display: flex; gap: 8px; margin-top: 14px; padding-top: 12px; border-top: 1px solid #2d2d2d; }
    .btn-action {
        font-size: 0.75rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 6px;
        font-family: 'Playfair Display', serif;
        cursor: pointer;
        transition: .2s;
    }
    .btn-edit  { background: transparent; border: 1px solid #d4af37; color: #d4af37; }
    .btn-edit:hover  { background: #d4af37; color: #111; }
    .btn-delete { background: transparent; border: 1px solid #7d2e2e; color: #e07070; }
    .btn-delete:hover { background: #7d2e2e; color: #fff; }

    /* ── Empty State ── */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #555;
    }
    .empty-state i { font-size: 2.5rem; color: #333; margin-bottom: 16px; display: block; }
    .empty-state p { font-size: 1rem; }

    /* ── Alerts ── */
    .alert-luxury {
        border-radius: 10px;
        padding: 12px 18px;
        font-size: 0.9rem;
        margin-bottom: 20px;
    }
    .alert-success-luxury { background: rgba(30,58,47,.8); border: 1px solid #2e7d52; color: #7fffa8; }
    .alert-error-luxury   { background: rgba(58,30,30,.8); border: 1px solid #7d2e2e; color: #ffb2b2; }

    /* ── Pagination ── */
    .pagination .page-link {
        background-color: #2a2a2a;
        border-color: #3a3a3a;
        color: #eaeaea;
        font-family: 'Playfair Display', serif;
    }
    .pagination .page-link:hover { background-color: #d4af37; border-color: #d4af37; color: #111; }
    .pagination .page-item.active .page-link { background-color: #d4af37; border-color: #d4af37; color: #111; }
    .pagination .page-item.disabled .page-link { background-color: #1e1e1e; color: #555; }
</style>

{{-- ── Page Header ── --}}
<div class="page-header" data-aos="fade-down">
    <p class="eyebrow">Baratie Resto</p>
    <h1>Guest Reviews</h1>
    <div class="gold-divider">
        <span></span><i class="fa fa-star"></i><span></span>
    </div>
</div>

<div class="container pb-5">

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert-luxury alert-success-luxury" data-aos="fade-in">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-luxury alert-error-luxury" data-aos="fade-in">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="review-layout">

        {{-- ── Form Panel ── --}}
        <div data-aos="fade-right">
            <div class="form-panel">
                <h4>Leave a Review</h4>

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="kategori" class="form-label">Category</label>
                        <select class="form-select" id="kategori" name="kategori" onchange="filterMenus()">
                            <option value="">— All Categories —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                                    {{ ucfirst($category) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_menu" class="form-label">Menu Item <span style="color:#d4af37">*</span></label>
                        <select class="form-select" id="id_menu" name="id_menu" required>
                            <option value="" disabled selected>— Select a Menu —</option>
                            @foreach ($menus as $menu)
                                <option value="{{ $menu->id }}" {{ old('id_menu') == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->nama_menu }} — Rp{{ number_format($menu->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rating <span style="color:#d4af37">*</span></label>
                        <div class="star-group" id="star-group">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                    {{ old('rating') == $i ? 'checked' : '' }} required>
                                <label for="star{{ $i }}" title="{{ $i }} bintang">&#9733;</label>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="note" class="form-label">Your Review</label>
                        <textarea class="form-control" id="note" name="note" rows="4"
                            placeholder="Share your dining experience...">{{ old('note') }}</textarea>
                    </div>

                    <button type="submit" class="btn-gold">Submit Review</button>
                </form>
            </div>
        </div>

        {{-- ── Review List ── --}}
        <div data-aos="fade-left">
            <div class="reviews-header">
                <h4>What Our Guests Say</h4>
                <span class="reviews-count">{{ $reviews->total() }} review{{ $reviews->total() != 1 ? 's' : '' }}</span>
            </div>

            @forelse ($reviews as $review)
                <div class="card-review" data-aos="fade-up">
                    {{-- Reviewer Info --}}
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ $review->user->gambar ? asset($review->user->gambar) : asset('public/images/default.png') }}"
                             class="reviewer-avatar" alt="{{ $review->user->nama_pelanggan ?? 'User' }}">
                        <div>
                            <div class="reviewer-name">{{ $review->user->nama_pelanggan ?? 'Anonymous' }}</div>
                            <div class="review-date">{{ $review->created_at->format('d M Y') }}</div>
                        </div>
                        <div class="ms-auto stars-display">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="{{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}">&#9733;</span>
                            @endfor
                        </div>
                    </div>

                    {{-- Menu Badge --}}
                    @if($review->menu)
                        <span class="menu-badge">
                            {{ $review->menu->nama_menu }}
                            — Rp{{ number_format($review->menu->harga, 0, ',', '.') }}
                        </span>
                    @endif

                    {{-- Review Note --}}
                    @if($review->note)
                        <p class="review-note">{{ $review->note }}</p>
                    @endif

                    {{-- Edit / Delete (hanya milik sendiri) --}}
                    @auth
                        @if(auth()->id() === $review->id_user)
                            <div class="review-actions">
                                <a href="{{ route('review.edit', $review->id) }}" class="btn-action btn-edit">Edit</a>
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus review ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">Hapus</button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            @empty
                <div class="empty-state">
                    <i class="fa fa-comment-o"></i>
                    <p>Belum ada review. Jadilah yang pertama!</p>
                </div>
            @endforelse

            {{-- Pagination --}}
            @if($reviews->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });

    function filterMenus() {
        const cat = document.getElementById('kategori').value;
        const url = new URL(window.location.href);
        url.searchParams.set('kategori', cat);
        window.location.href = url.toString();
    }
</script>

@endsection

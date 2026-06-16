@extends('web.layout.nav')
@section('title', 'Baratie Resto — Fine Dining in Yogyakarta')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700,700i|Cormorant+Garamond:300,400,600i&display=swap" rel="stylesheet">

<style>
    body { background: #0f0f0f; color: #eaeaea; font-family: 'Playfair Display', serif; overflow-x: hidden; padding-top: 0 !important; }

    /* ── TOKENS ── */
    :root {
        --gold: #d4af37;
        --gold2: #b8962e;
        --gold-dim: rgba(212,175,55,.18);
        --dark: #0f0f0f;
        --card: #161616;
        --card2: #1c1c1c;
        --muted: #666;
    }

    /* ── HELPERS ── */
    .eyebrow { letter-spacing:.42em; font-size:.7rem; color:var(--gold); text-transform:uppercase; font-family:'Playfair Display',serif; }
    .gold-line { display:flex; align-items:center; justify-content:center; gap:14px; margin:16px 0; }
    .gold-line span { height:1px; width:70px; background:var(--gold); opacity:.4; display:block; }
    .gold-line i { color:var(--gold); font-size:.65rem; }
    .section-pad { padding:110px 0; }
    .section-pad-sm { padding:70px 0; }

    /* ════════════════════════════════
       1. HERO
    ════════════════════════════════ */
    .hero {
        position: relative;
        height: 100vh;
        min-height: 680px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-slides { position:absolute; inset:0; }
    .hero-slide {
        position:absolute; inset:0;
        background-size:cover; background-position:center;
        opacity:0; transition:opacity 1.4s ease;
    }
    .hero-slide.active { opacity:1; }
    .hero-slide::after {
        content:'';
        position:absolute; inset:0;
        background: linear-gradient(
            160deg,
            rgba(0,0,0,.72) 0%,
            rgba(0,0,0,.45) 50%,
            rgba(0,0,0,.78) 100%
        );
    }

    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 820px;
        padding: 0 24px;
    }
    .hero-eyebrow {
        letter-spacing:.5em; font-size:.72rem; color:var(--gold);
        text-transform:uppercase; margin-bottom:22px;
        opacity:0; animation:fadeUp .9s .3s forwards;
    }
    .hero-title {
        font-family:'Cormorant Garamond',serif;
        font-size: clamp(3rem, 8vw, 6.5rem);
        font-weight:300; color:#fff; line-height:1.05;
        margin-bottom:28px;
        opacity:0; animation:fadeUp .9s .55s forwards;
    }
    .hero-title em { color:var(--gold); font-style:italic; }
    .hero-sub {
        font-size: clamp(.88rem, 2vw, 1.05rem);
        color:rgba(255,255,255,.6); line-height:1.8;
        max-width:560px; margin:0 auto 44px;
        opacity:0; animation:fadeUp .9s .8s forwards;
    }
    .hero-cta {
        display:flex; gap:16px; justify-content:center; flex-wrap:wrap;
        opacity:0; animation:fadeUp .9s 1s forwards;
    }
    .btn-hero-primary {
        background:linear-gradient(135deg,var(--gold),var(--gold2));
        color:#111; font-weight:700; font-size:.8rem;
        letter-spacing:.18em; text-transform:uppercase;
        padding:16px 36px; border-radius:2px; border:none;
        text-decoration:none; transition:.25s;
        font-family:'Playfair Display',serif;
    }
    .btn-hero-primary:hover { opacity:.88; transform:translateY(-2px); color:#111; }
    .btn-hero-ghost {
        background:transparent; color:#fff; font-size:.8rem;
        letter-spacing:.18em; text-transform:uppercase;
        padding:15px 36px; border-radius:2px;
        border:1px solid rgba(255,255,255,.35);
        text-decoration:none; transition:.25s;
        font-family:'Playfair Display',serif;
    }
    .btn-hero-ghost:hover { border-color:var(--gold); color:var(--gold); }

    /* Slide dots */
    .hero-dots {
        position:absolute; bottom:36px; left:50%; transform:translateX(-50%);
        display:flex; gap:10px; z-index:10;
    }
    .hero-dot {
        width:6px; height:6px; border-radius:50%;
        background:rgba(255,255,255,.3); cursor:pointer;
        transition:.3s; border:none; padding:0;
    }
    .hero-dot.active { background:var(--gold); width:24px; border-radius:4px; }

    /* Scroll indicator */
    .scroll-hint {
        position:absolute; bottom:36px; right:40px; z-index:10;
        display:flex; flex-direction:column; align-items:center; gap:8px;
        opacity:0; animation:fadeIn 1s 1.6s forwards;
    }
    .scroll-hint span { font-size:.6rem; letter-spacing:.3em; color:rgba(255,255,255,.4); text-transform:uppercase; writing-mode:vertical-rl; }
    .scroll-line { width:1px; height:56px; background:linear-gradient(to bottom,transparent,var(--gold)); animation:scrollPulse 2s 2s infinite; }

    /* ════════════════════════════════
       SECTION GRADIENT TRANSITIONS
    ════════════════════════════════ */
    /* Hero bottom → About (#161616) */
    .hero::after {
        content:''; position:absolute; bottom:0; left:0; right:0;
        height:160px;
        background:linear-gradient(to bottom, transparent, #161616);
        pointer-events:none; z-index:6;
    }
    /* Generic divider */
    .sec-sep { display:block; height:80px; flex-shrink:0; }
    .s-about-pillars { background:linear-gradient(to bottom, #161616, #0f0f0f); }
    .s-pillars-menu  { background:linear-gradient(to bottom, #0f0f0f, #161616); }
    .s-menu-gallery  { background:linear-gradient(to bottom, #161616, #0f0f0f); }
    .s-gallery-chef  { background:linear-gradient(to bottom, #0f0f0f, #1c1c1c); }
    .s-chef-reviews  { background:linear-gradient(to bottom, #1c1c1c, #0f0f0f); }
    .s-reviews-cta   { background:linear-gradient(to bottom, #0f0f0f, #050505); }

    /* ════════════════════════════════
       3. ABOUT / STORY
    ════════════════════════════════ */
    .about-grid {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:0;
        align-items:stretch;
    }
    @media(max-width:991px){ .about-grid{ grid-template-columns:1fr; } }

    .about-img-wrap {
        position:relative; overflow:hidden;
        min-height:560px;
    }
    .about-img-wrap img { width:100%; height:100%; object-fit:cover; display:block; transition:transform 8s ease; }
    .about-img-wrap:hover img { transform:scale(1.04); }
    .about-img-badge {
        position:absolute; bottom:40px; right:-1px;
        background:var(--gold); color:#111;
        padding:18px 28px; text-align:center;
        font-family:'Cormorant Garamond',serif;
    }
    .about-img-badge .badge-num { font-size:2.2rem; font-weight:600; display:block; line-height:1; }
    .about-img-badge .badge-text { font-size:.7rem; letter-spacing:.18em; text-transform:uppercase; display:block; margin-top:4px; }

    .about-text {
        background: var(--card);
        padding: 80px 64px;
        display:flex; flex-direction:column; justify-content:center;
    }
    @media(max-width:1199px){ .about-text { padding:60px 40px; } }
    @media(max-width:767px){ .about-text { padding:56px 28px; } }
    .about-text h2 { font-family:'Cormorant Garamond',serif; font-size:2.6rem; font-weight:400; color:#fff; margin-bottom:20px; line-height:1.25; }
    .about-text h2 em { color:var(--gold); }
    .about-text p { color:#888; font-size:.95rem; line-height:1.9; margin-bottom:16px; }
    .about-text blockquote {
        border-left:3px solid var(--gold); padding:12px 20px;
        margin:28px 0; color:#bbb; font-style:italic; font-size:1.05rem;
        background:rgba(212,175,55,.05);
    }
    .btn-about {
        display:inline-flex; align-items:center; gap:10px;
        border:1px solid var(--gold-dim); color:var(--gold);
        padding:13px 28px; font-size:.78rem; letter-spacing:.15em;
        text-transform:uppercase; text-decoration:none;
        transition:.25s; margin-top:8px; align-self:flex-start;
        font-family:'Playfair Display',serif;
    }
    .btn-about:hover { background:var(--gold); color:#111; }
    .btn-about i { font-size:.8rem; transition:transform .2s; }
    .btn-about:hover i { transform:translateX(4px); }

    /* ════════════════════════════════
       4. EXPERIENCE PILLARS
    ════════════════════════════════ */
    .pillars { background:var(--dark); }
    .pillar-card {
        text-align:center; padding:52px 36px;
        border:1px solid var(--gold-dim); border-radius:2px;
        transition:border-color .3s, transform .3s;
        height:100%;
    }
    .pillar-card:hover { border-color:var(--gold); transform:translateY(-6px); }
    .pillar-icon {
        width:68px; height:68px; border-radius:50%;
        background:rgba(212,175,55,.08); border:1px solid rgba(212,175,55,.25);
        display:flex; align-items:center; justify-content:center;
        margin:0 auto 24px;
    }
    .pillar-icon i { color:var(--gold); font-size:1.4rem; }
    .pillar-card h4 { color:#fff; font-size:1.1rem; margin-bottom:14px; letter-spacing:.04em; }
    .pillar-card p { color:var(--muted); font-size:.88rem; line-height:1.85; margin:0; }

    /* ════════════════════════════════
       5. MENU SHOWCASE
    ════════════════════════════════ */
    .menu-section { background: var(--card); }
    .menu-card {
        position:relative; overflow:hidden; border-radius:2px;
        cursor:pointer; display:block; text-decoration:none;
    }
    .menu-card img {
        width:100%; height:320px; object-fit:cover;
        display:block; transition:transform .7s ease;
    }
    .menu-card:hover img { transform:scale(1.08); }
    .menu-card-overlay {
        position:absolute; inset:0;
        background:linear-gradient(to top, rgba(0,0,0,.88) 0%, rgba(0,0,0,.2) 60%, transparent 100%);
        transition:background .4s;
    }
    .menu-card:hover .menu-card-overlay { background:linear-gradient(to top, rgba(0,0,0,.94) 0%, rgba(0,0,0,.4) 60%, rgba(0,0,0,.1) 100%); }
    .menu-card-body {
        position:absolute; bottom:0; left:0; right:0;
        padding:28px 24px;
    }
    .menu-card-cat { font-size:.62rem; letter-spacing:.3em; color:var(--gold); text-transform:uppercase; margin-bottom:8px; display:block; }
    .menu-card-title { font-family:'Cormorant Garamond',serif; font-size:1.6rem; color:#fff; margin:0 0 10px; font-weight:400; }
    .menu-card-desc { color:rgba(255,255,255,.55); font-size:.82rem; line-height:1.6; margin:0 0 16px; max-height:0; overflow:hidden; transition:max-height .4s ease; }
    .menu-card:hover .menu-card-desc { max-height:60px; }
    .menu-card-link {
        display:inline-flex; align-items:center; gap:6px;
        color:var(--gold); font-size:.72rem; letter-spacing:.2em;
        text-transform:uppercase; opacity:0; transform:translateY(8px);
        transition:.3s;
    }
    .menu-card:hover .menu-card-link { opacity:1; transform:translateY(0); }

    /* ════════════════════════════════
       6. GALLERY STRIP
    ════════════════════════════════ */
    .gallery-strip { background:var(--dark); }
    .gallery-track {
        display:flex; gap:4px;
        animation:scrollTrack 30s linear infinite;
        width:max-content;
    }
    .gallery-track:hover { animation-play-state:paused; }
    .gallery-item { width:280px; height:200px; flex-shrink:0; overflow:hidden; }
    .gallery-item img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
    .gallery-item:hover img { transform:scale(1.08); }

    /* ════════════════════════════════
       7. CHEF'S SPECIAL
    ════════════════════════════════ */
    .special-section { background:var(--card2); }
    .special-img-wrap { position:relative; }
    .special-img-wrap img { width:100%; height:480px; object-fit:cover; border-radius:2px; }
    .special-badge {
        position:absolute; top:28px; left:28px;
        background:var(--gold); color:#111;
        font-size:.68rem; letter-spacing:.22em;
        text-transform:uppercase; padding:8px 16px; border-radius:2px;
        font-weight:700;
    }
    .special-text { padding:0 0 0 56px; display:flex; flex-direction:column; justify-content:center; }
    @media(max-width:991px){ .special-text { padding:40px 0 0; } }
    .special-text h2 { font-family:'Cormorant Garamond',serif; font-size:2.4rem; font-weight:400; color:#fff; margin-bottom:18px; }
    .special-text h2 em { color:var(--gold); }
    .special-text p { color:#888; font-size:.95rem; line-height:1.9; margin-bottom:14px; }
    .special-detail {
        display:flex; align-items:center; gap:10px;
        padding:12px 0; border-bottom:1px solid #1e1e1e;
        color:#aaa; font-size:.85rem;
    }
    .special-detail i { color:var(--gold); width:18px; text-align:center; }

    /* ════════════════════════════════
       8. TESTIMONIALS
    ════════════════════════════════ */
    .reviews-section { background:var(--dark); }
    .review-card {
        background:var(--card);
        border:1px solid var(--gold-dim);
        border-radius:2px;
        padding:36px 32px;
        height:100%;
        transition:border-color .3s, transform .25s;
    }
    .review-card:hover { border-color:rgba(212,175,55,.45); transform:translateY(-4px); }
    .review-stars { display:flex; gap:3px; margin-bottom:20px; }
    .review-stars i { color:var(--gold); font-size:.85rem; }
    .review-quote { font-family:'Cormorant Garamond',serif; font-size:1.1rem; color:#ccc; line-height:1.75; margin-bottom:24px; font-style:italic; }
    .review-quote::before { content:'\201C'; color:var(--gold); font-size:2rem; line-height:0; vertical-align:-.5rem; margin-right:4px; }
    .review-author { display:flex; align-items:center; gap:14px; }
    .review-avatar { width:44px; height:44px; border-radius:50%; object-fit:cover; border:2px solid rgba(212,175,55,.3); }
    .review-name { color:#fff; font-size:.88rem; font-weight:600; }
    .review-dish { color:var(--muted); font-size:.75rem; letter-spacing:.06em; margin-top:2px; }

    /* ════════════════════════════════
       9. RESERVATION CTA
    ════════════════════════════════ */
    .cta-section {
        position:relative; overflow:hidden;
        background:url('{{ asset("public/images/reservation.jpg") }}') center/cover no-repeat;
        padding:130px 0;
    }
    .cta-section::before {
        content:'';
        position:absolute; inset:0;
        background:linear-gradient(135deg, rgba(0,0,0,.88) 0%, rgba(0,0,0,.7) 100%);
    }
    .cta-inner { position:relative; z-index:2; text-align:center; }
    .cta-inner h2 { font-family:'Cormorant Garamond',serif; font-size:clamp(2.2rem,5vw,4rem); font-weight:300; color:#fff; margin-bottom:16px; }
    .cta-inner h2 em { color:var(--gold); }
    .cta-inner p { color:rgba(255,255,255,.55); font-size:.95rem; max-width:480px; margin:0 auto 44px; line-height:1.8; }
    .btn-cta {
        display:inline-flex; align-items:center; gap:12px;
        background:linear-gradient(135deg,var(--gold),var(--gold2));
        color:#111; font-weight:700; font-size:.82rem;
        letter-spacing:.18em; text-transform:uppercase;
        padding:18px 44px; border-radius:2px; text-decoration:none;
        transition:.25s; font-family:'Playfair Display',serif;
    }
    .btn-cta:hover { opacity:.88; transform:translateY(-2px); color:#111; }

    /* ════════════════════════════════
       ANIMATIONS
    ════════════════════════════════ */
    @keyframes fadeUp { from { opacity:0; transform:translateY(22px); } to { opacity:1; transform:translateY(0); } }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    @keyframes scrollPulse { 0%,100%{ opacity:.3; transform:scaleY(.6); } 50%{ opacity:1; transform:scaleY(1); } }
    @keyframes scrollTrack { from { transform:translateX(0); } to { transform:translateX(-50%); } }

    /* ════════════════════════════════
       RESPONSIVE
    ════════════════════════════════ */
    @media(max-width:575px){
        .hero-cta { flex-direction:column; align-items:center; }
        .btn-hero-primary, .btn-hero-ghost { width:200px; text-align:center; }
        .scroll-hint { display:none; }
        .special-text { padding:36px 0 0; }
    }
</style>

{{-- ════════════════════════════════
     1. HERO
════════════════════════════════ --}}
<section class="hero">
    <div class="hero-slides">
        <div class="hero-slide active" style="background-image:url('{{ asset('public/images/head(1).jpg') }}')"></div>
        <div class="hero-slide"        style="background-image:url('{{ asset('public/images/head(2).jpg') }}')"></div>
        <div class="hero-slide"        style="background-image:url('{{ asset('public/images/head(3).jpg') }}')"></div>
    </div>

    <div class="hero-content">
        <p class="hero-eyebrow">Est. 2016 &nbsp;·&nbsp; Yogyakarta, Indonesia</p>
        <h1 class="hero-title">
            Where Every Bite<br><em>Tells a Story</em>
        </h1>
        <p class="hero-sub">
            A sanctuary of fine dining where culinary art meets heartfelt hospitality —
            crafting unforgettable moments, one plate at a time.
        </p>
        <div class="hero-cta">
            <a href="{{ route('web.reservation.create') }}" class="btn-hero-primary">
                Reserve a Table
            </a>
            <a href="{{ url('web/menu') }}" class="btn-hero-ghost">
                Explore Menu
            </a>
        </div>
    </div>

    <div class="hero-dots" id="heroDots">
        <button class="hero-dot active" onclick="goSlide(0)"></button>
        <button class="hero-dot" onclick="goSlide(1)"></button>
        <button class="hero-dot" onclick="goSlide(2)"></button>
    </div>

    <div class="scroll-hint">
        <span>Scroll</span>
        <div class="scroll-line"></div>
    </div>
</section>


{{-- ════════════════════════════════
     3. ABOUT / STORY
════════════════════════════════ --}}
<section>
    <div class="about-grid">
        <div class="about-img-wrap" data-aos="fade-right" data-aos-duration="900">
            <img src="{{ asset('public/images/about.jpg') }}" alt="Baratie Resto Interior">
            <div class="about-img-badge">
                <span class="badge-num">8</span>
                <span class="badge-text">Years Serving</span>
            </div>
        </div>
        <div class="about-text" data-aos="fade-left" data-aos-duration="900">
            <p class="eyebrow">Our Story</p>
            <h2>Born from <em>Passion,</em><br>Crafted with Soul</h2>
            <blockquote>
                "We don't just cook food — we compose experiences that linger long after the last bite."
            </blockquote>
            <p>
                Baratie Resto was born from a simple belief: that truly great food has the power to connect people,
                spark conversation, and create memories that outlast the moment. Founded in 2016 in the heart of
                Yogyakarta, we set out to build not just a restaurant, but a culinary destination.
            </p>
            <p>
                Every dish on our menu is a conversation between tradition and innovation — rooted in the rich
                flavors of Indonesian heritage, elevated with modern techniques and the finest locally-sourced
                ingredients.
            </p>
            <a href="{{ url('web/about') }}" class="btn-about">
                Our Full Story <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<span class="sec-sep s-about-pillars"></span>

{{-- ════════════════════════════════
     4. EXPERIENCE PILLARS
════════════════════════════════ --}}
<section class="pillars section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="eyebrow">The Baratie Way</p>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:300;color:#fff;margin:14px 0 0;">
                Three Pillars of an <em style="color:var(--gold);">Extraordinary</em> Evening
            </h2>
            <div class="gold-line"><span></span><i class="fa-solid fa-star"></i><span></span></div>
        </div>

        <div class="row g-4">
            @foreach([
                ['fa-seedling',   'Farm-to-Fork Ingredients',
                 'Every ingredient is hand-selected at peak freshness — from local farms to your plate, with zero compromise on quality.'],
                ['fa-hat-chef',   'Artisan Craftsmanship',
                 'Our chefs bring decades of combined expertise to every dish, blending technique with creativity to produce flavors that surprise and delight.'],
                ['fa-wine-glass', 'Curated Ambiance',
                 'Dine in an atmosphere meticulously designed to engage every sense — warm lighting, curated music, and attentive service that never overshadows.'],
            ] as [$icon, $title, $desc])
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 130 }}">
                <div class="pillar-card">
                    <div class="pillar-icon"><i class="fa-solid {{ $icon }}"></i></div>
                    <h4>{{ $title }}</h4>
                    <p>{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<span class="sec-sep s-pillars-menu"></span>

{{-- ════════════════════════════════
     5. MENU SHOWCASE
════════════════════════════════ --}}
<section class="menu-section section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="eyebrow">Explore</p>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:2.6rem;font-weight:300;color:#fff;margin:14px 0 0;">
                A Menu That <em style="color:var(--gold);">Surprises</em> at Every Turn
            </h2>
            <div class="gold-line"><span></span><i class="fa-solid fa-utensils"></i><span></span></div>
            <p style="color:var(--muted);max-width:500px;margin:0 auto;font-size:.92rem;line-height:1.75;">
                From delicate starters to indulgent desserts — each section of our menu is a world of its own,
                waiting to be discovered.
            </p>
        </div>

        <div class="row g-3">
            @foreach([
                ['Appetizer',   'hmenu1.jpg', 'Appetizer',
                 'Delicate starters crafted to awaken the palate — fresh, bold, and beautifully presented.'],
                ['Main Course', 'hmenu2.jpg', 'Main Course',
                 'Signature centrepieces built on tradition, elevated with modern culinary technique.'],
                ['Dessert',     'hmenu3.jpg', 'Dessert',
                 'Sweet finales that linger — from velvety tiramisu to our showstopping molten lava cake.'],
                ['Drinks',      'hmenu4.jpg', 'Drink',
                 'Handcrafted beverages from single-origin coffees to artisan mocktails and sommelier wines.'],
            ] as [$cat, $img, $anchor, $desc])
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <a href="{{ url('web/menu') }}#{{ strtolower(str_replace(' ','',$anchor)) }}"
                   class="menu-card d-block">
                    <img src="{{ asset('public/images/' . $img) }}" alt="{{ $cat }}">
                    <div class="menu-card-overlay"></div>
                    <div class="menu-card-body">
                        <span class="menu-card-cat">{{ $cat }}</span>
                        <h3 class="menu-card-title">{{ $cat }}</h3>
                        <p class="menu-card-desc">{{ $desc }}</p>
                        <span class="menu-card-link">
                            Explore <i class="fa-solid fa-arrow-right" style="font-size:.65rem;"></i>
                        </span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ url('web/menu') }}"
               style="display:inline-flex;align-items:center;gap:10px;border:1px solid var(--gold-dim);color:var(--gold);padding:14px 32px;font-size:.78rem;letter-spacing:.18em;text-transform:uppercase;text-decoration:none;transition:.25s;font-family:'Playfair Display',serif;"
               onmouseover="this.style.background='var(--gold)';this.style.color='#111'"
               onmouseout="this.style.background='transparent';this.style.color='var(--gold)'">
                View Full Menu &nbsp;<i class="fa-solid fa-arrow-right" style="font-size:.7rem;"></i>
            </a>
        </div>
    </div>
</section>

<span class="sec-sep s-menu-gallery"></span>

{{-- ════════════════════════════════
     6. GALLERY STRIP
════════════════════════════════ --}}
<section class="gallery-strip section-pad-sm" data-aos="fade-up">
    <div class="text-center mb-5 container">
        <p class="eyebrow">Gallery</p>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:2.2rem;font-weight:300;color:#fff;margin:14px 0 0;">
            Beauty on <em style="color:var(--gold);">Every Plate</em>
        </h2>
    </div>
    @php
        $galleryImgs = ['wagyu.jpeg','salmon.jpeg','tiramisu.jpeg','bruschetta.jpeg',
                        'lamb.jpeg','seafood.jpeg','steak.jpg','cheesecake.jpeg',
                        'beef_steak.jpg','salmon_teriyaki.jpg'];
    @endphp
    <div style="overflow:hidden;">
        <div class="gallery-track">
            @foreach(array_merge($galleryImgs,$galleryImgs) as $img)
            <div class="gallery-item">
                <img src="{{ asset('public/images/' . $img) }}" alt="dish">
            </div>
            @endforeach
        </div>
    </div>
</section>

<span class="sec-sep s-gallery-chef"></span>

{{-- ════════════════════════════════
     7. CHEF'S SPECIAL
════════════════════════════════ --}}
<section class="special-section section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right" data-aos-duration="900">
                <div class="special-img-wrap">
                    <img src="{{ asset('public/images/wagyu.jpeg') }}" alt="Chef's Special — Wagyu Beef">
                    <span class="special-badge">Chef's Special</span>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left" data-aos-duration="900">
                <div class="special-text">
                    <p class="eyebrow">This Month's Feature</p>
                    <h2>Wagyu A5 &nbsp;<em>Striploin</em><br>with Truffle Jus</h2>
                    <p>
                        Our executive chef presents the crown jewel of our current menu — a meticulously
                        sourced Japanese A5 Wagyu, seared to perfection and finished with hand-shaved
                        black truffle, a rich demi-glace jus, and micro-herb garnish.
                    </p>
                    <p>
                        Served with roasted bone marrow butter and a side of duck-fat potato confit,
                        this is a dish that demands to be savored slowly — one exquisite bite at a time.
                    </p>

                    <div class="special-detail">
                        <i class="fa-solid fa-fire-flame-curved"></i>
                        <span>Grilled over binchōtan charcoal at 800°C for the perfect Maillard crust</span>
                    </div>
                    <div class="special-detail">
                        <i class="fa-solid fa-leaf"></i>
                        <span>Paired with seasonal micro-greens from our partner farm in Magelang</span>
                    </div>
                    <div class="special-detail" style="border-bottom:none;">
                        <i class="fa-solid fa-wine-glass"></i>
                        <span>Wine pairing available — ask your server for our sommelier's recommendation</span>
                    </div>

                    <div class="d-flex align-items-center gap-4 mt-5 flex-wrap">
                        <div>
                            <span style="color:var(--muted);font-size:.68rem;letter-spacing:.2em;text-transform:uppercase;display:block;margin-bottom:4px;">Starting from</span>
                            <span style="font-family:'Cormorant Garamond',serif;font-size:2rem;color:var(--gold);font-weight:600;">Rp 380.000</span>
                        </div>
                        <a href="{{ route('web.reservation.create') }}" class="btn-about">
                            Reserve Now <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<span class="sec-sep s-chef-reviews"></span>

{{-- ════════════════════════════════
     8. TESTIMONIALS
════════════════════════════════ --}}
<section class="reviews-section section-pad">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="eyebrow">What Guests Say</p>
            <h2 style="font-family:'Cormorant Garamond',serif;font-size:2.4rem;font-weight:300;color:#fff;margin:14px 0 0;">
                Voices of <em style="color:var(--gold);">Satisfied</em> Guests
            </h2>
            <div class="gold-line"><span></span><i class="fa-solid fa-heart"></i><span></span></div>
        </div>

        <div class="row g-4">
            @foreach([
                ['person1.jpeg', 'Sarah Wijaya',    'Wagyu Striploin',
                 'Absolutely breathtaking. The wagyu melted in my mouth and the ambiance made the evening feel like a special occasion — even though it was just a Tuesday night. Baratie has earned a permanent spot in my heart.'],
                ['person2.jpeg', 'Reza Firmansyah', 'Truffle Pasta',
                 'I\'ve dined at fine restaurants across three continents, and Baratie holds its own beautifully. The truffle pasta was deeply aromatic, perfectly balanced. The service was attentive without being intrusive — rare and refreshing.'],
                ['person3.jpeg', 'Lita Maharani',   'Tasting Menu',
                 'We hosted our anniversary dinner here and the team went above and beyond. The seven-course tasting menu was a journey — each plate told a story. The dessert platter arrived with a personalized gold-leaf card. Magical.'],
            ] as [$avatar, $name, $dish, $quote])
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 120 }}">
                <div class="review-card">
                    <div class="review-stars">
                        @for($i=0;$i<5;$i++)<i class="fa-solid fa-star"></i>@endfor
                    </div>
                    <p class="review-quote">{{ $quote }}</p>
                    <div class="review-author">
                        <img src="{{ asset('public/images/' . $avatar) }}" class="review-avatar" alt="{{ $name }}">
                        <div>
                            <div class="review-name">{{ $name }}</div>
                            <div class="review-dish">Ordered: {{ $dish }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="{{ route('web.review') }}"
               style="color:var(--gold);font-size:.78rem;letter-spacing:.18em;text-transform:uppercase;text-decoration:none;border-bottom:1px solid rgba(212,175,55,.3);padding-bottom:3px;">
                Read More Reviews &nbsp;→
            </a>
        </div>
    </div>
</section>

<span class="sec-sep s-reviews-cta"></span>

{{-- ════════════════════════════════
     9. RESERVATION CTA
════════════════════════════════ --}}
<section class="cta-section" data-aos="fade-up">
    <div class="cta-inner container">
        <p class="eyebrow" style="margin-bottom:16px;">Book Your Table</p>
        <h2>An Evening You'll<br><em>Remember Forever</em></h2>
        <p>
            Tables fill quickly, especially on weekends. Secure your spot now and let us
            craft an evening tailored entirely to you.
        </p>
        <a href="{{ route('web.reservation.create') }}" class="btn-cta">
            <i class="fa-solid fa-calendar-check" style="font-size:.9rem;"></i>
            Make a Reservation
        </a>
        <p style="color:rgba(255,255,255,.28);font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;margin-top:22px;">
            Or call us directly at &nbsp;<span style="color:var(--gold);">+62 1234 5678</span>
        </p>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration:700, once:true, offset:60 });

/* ── Hero Slideshow ── */
let current = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots   = document.querySelectorAll('.hero-dot');

function goSlide(n) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (n + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
}

const autoSlide = setInterval(() => goSlide(current + 1), 5500);

</script>

@endsection

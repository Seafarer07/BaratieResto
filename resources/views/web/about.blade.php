@extends('web.layout.nav')
@section('title', 'About — Baratie Resto')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i&display=swap" rel="stylesheet">

<style>
    body { background-color: #1a1a1a; font-family: 'Playfair Display', serif; color: #eaeaea; }

    /* ── Shared ── */
    .eyebrow {
        letter-spacing: .35em; font-size: .78rem; color: #d4af37;
        text-transform: uppercase; margin-bottom: 10px;
    }
    .gold-divider {
        display: flex; align-items: center; justify-content: center; gap: 12px;
        margin: 14px auto 0;
    }
    .gold-divider span { display: block; height: 1px; width: 80px; background: #d4af37; opacity: .5; }
    .gold-divider i    { color: #d4af37; font-size: .7rem; }

    /* ── Page Header ── */
    .page-header { text-align: center; padding: 60px 0 50px; }
    .page-header h1 { font-size: 2.8rem; font-weight: 700; color: #fff; margin-bottom: 14px; }
    .page-header .lead { color: #888; font-size: .95rem; max-width: 580px; margin: 10px auto 0; line-height: 1.7; }

    /* ── Story Section ── */
    .story-grid {
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 48px;
        align-items: center;
        padding: 20px 0 60px;
    }
    @media (max-width: 767px) { .story-grid { grid-template-columns: 1fr; } }

    .story-img-wrap {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(212,175,55,.2);
    }
    .story-img-wrap img { width: 100%; height: 420px; object-fit: cover; display: block; }
    .story-img-wrap::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(to top, rgba(26,26,26,.6), transparent 60%);
    }

    .story-text h2 { font-size: 2rem; color: #fff; margin-bottom: 18px; line-height: 1.3; }
    .story-text h2 em { color: #d4af37; font-style: italic; }
    .story-text p { color: #999; font-size: .95rem; line-height: 1.85; margin-bottom: 14px; }
    .story-text .quote {
        border-left: 3px solid #d4af37;
        padding: 10px 18px;
        margin: 24px 0;
        color: #ccc;
        font-style: italic;
        font-size: 1.05rem;
    }

    /* ── Section Title ── */
    .section-title { text-align: center; padding: 60px 0 40px; }
    .section-title h2 { font-size: 2rem; color: #fff; margin-bottom: 0; }

    /* ── Achievements ── */
    .achievement-card {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.2);
        border-radius: 16px;
        padding: 36px 24px;
        text-align: center;
        transition: border-color .25s, transform .2s;
        height: 100%;
    }
    .achievement-card:hover {
        border-color: rgba(212,175,55,.6);
        transform: translateY(-4px);
    }
    .achievement-card .icon {
        width: 56px; height: 56px;
        border-radius: 50%;
        background: rgba(212,175,55,.1);
        border: 1px solid rgba(212,175,55,.3);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
    }
    .achievement-card .icon i { color: #d4af37; font-size: 1.3rem; }
    .achievement-card h5 { color: #fff; font-size: 1rem; margin-bottom: 6px; }
    .achievement-card p  { color: #777; font-size: .82rem; margin: 0; letter-spacing: .04em; }

    /* ── Chef Flip Cards ── */
    .flip-card {
        perspective: 1000px;
        height: 280px;
    }
    .flip-card-inner {
        position: relative; width: 100%; height: 100%;
        transition: transform .6s;
        transform-style: preserve-3d;
    }
    .flip-card:hover .flip-card-inner { transform: rotateY(180deg); }

    .flip-card-front, .flip-card-back {
        position: absolute; inset: 0;
        backface-visibility: hidden;
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid rgba(212,175,55,.2);
    }
    .flip-card-front img { width: 100%; height: 100%; object-fit: cover; }
    .flip-card-back {
        background: linear-gradient(145deg, #232323, #1c1c1c);
        transform: rotateY(180deg);
        display: flex; align-items: center; justify-content: center;
        text-align: center; padding: 24px;
        border-color: rgba(212,175,55,.5);
    }
    .flip-card-back h5 { color: #d4af37; font-size: 1.1rem; margin-bottom: 8px; }
    .flip-card-back p  { color: #bbb; font-size: .85rem; margin: 0; line-height: 1.5; }
    .flip-card-back .role { font-size: .75rem; color: #666; letter-spacing: .1em; text-transform: uppercase; margin-bottom: 10px; display: block; }

    /* ── Stats ── */
    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    .stat-box {
        background: linear-gradient(145deg, #232323, #1e1e1e);
        border: 1px solid rgba(212,175,55,.15);
        border-radius: 12px;
        padding: 20px 16px;
        text-align: center;
        transition: border-color .25s;
    }
    .stat-box:hover { border-color: rgba(212,175,55,.4); }
    .stat-box .count { font-size: 2.2rem; font-weight: 700; color: #d4af37; display: block; margin-bottom: 4px; }
    .stat-box p { color: #777; font-size: .8rem; margin: 0; line-height: 1.4; }

    /* ── Team section layout ── */
    .team-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: center;
    }
    @media (max-width: 767px) { .team-grid { grid-template-columns: 1fr; } }

    .team-text h2 { font-size: 2rem; color: #fff; margin-bottom: 12px; }
    .team-text h2 em { color: #d4af37; font-style: italic; }
    .team-text > p { color: #888; font-size: .95rem; margin-bottom: 28px; line-height: 1.7; }
</style>

{{-- ── Page Header ── --}}
<div class="page-header" data-aos="fade-down">
    <p class="eyebrow">Baratie Resto</p>
    <h1>About Us</h1>
    <p class="lead">A culinary haven where tradition meets innovation — every dish tells a story.</p>
    <div class="gold-divider">
        <span></span><i class="fa fa-heart"></i><span></span>
    </div>
</div>

<div class="container pb-5">

    {{-- ── Story Section ── --}}
    <div class="story-grid">
        <div class="story-img-wrap" data-aos="fade-right">
            <img src="{{ asset('public/images/head(1).jpg') }}" alt="Baratie Resto">
        </div>
        <div class="story-text" data-aos="fade-left">
            <p class="eyebrow">Our Story</p>
            <h2>Where <em>Passion</em> Meets the Plate</h2>
            <p>Welcome to Baratie Resto — a place where culinary taste and warm atmosphere combine into one. Founded with a passion for serving high-quality food that blends rich traditional flavors with modern innovation.</p>
            <blockquote class="quote">
                Every dish has a story. We are proud to serve flavors inspired by local culture and international cuisine, prepared with the freshest ingredients.
            </blockquote>
            <p>Our warm ambiance, coupled with exceptional service, ensures every meal is a special occasion. Join us and enjoy the perfect dining experience.</p>
        </div>
    </div>

    {{-- ── Achievements ── --}}
    <div class="section-title" data-aos="fade-up">
        <p class="eyebrow">Recognition</p>
        <h2>Our Achievements</h2>
        <div class="gold-divider"><span></span><i class="fa fa-trophy"></i><span></span></div>
    </div>

    <div class="row g-4 mb-5">
        @foreach([
            ['fa-star',   'Michelin Star',       '2023 — International recognition for culinary excellence'],
            ['fa-trophy', 'Best Dessert Award',  '2022 — Voted by the National Culinary Association'],
            ['fa-leaf',   'James Beard Award',   '2023 — Outstanding contribution to culinary arts'],
        ] as [$icon, $title, $desc])
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 120 }}">
            <div class="achievement-card">
                <div class="icon"><i class="fa {{ $icon }}"></i></div>
                <h5>{{ $title }}</h5>
                <p>{{ $desc }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ── Team Section ── --}}
    <div class="section-title" data-aos="fade-up">
        <p class="eyebrow">The People</p>
        <h2>Meet The Team</h2>
        <div class="gold-divider"><span></span><i class="fa fa-users"></i><span></span></div>
    </div>

    <div class="team-grid mb-5">
        {{-- Chef Cards --}}
        <div data-aos="fade-right">
            <div class="row g-3">
                @foreach([
                    ['person1.jpeg', 'Ateng',    'Executive Chef',   'Best Chef Award 2023'],
                    ['person2.jpeg', 'Cece',     'Pastry Chef',      'Culinary Innovator 2022'],
                    ['person3.jpeg', 'Jembung',  'Sous Chef',        'Sustainable Cooking Award 2023'],
                ] as [$img, $name, $role, $award])
                <div class="col-4">
                    <div class="flip-card">
                        <div class="flip-card-inner">
                            <div class="flip-card-front">
                                <img src="{{ asset('public/images/' . $img) }}" alt="{{ $name }}">
                            </div>
                            <div class="flip-card-back">
                                <div>
                                    <span class="role">{{ $role }}</span>
                                    <h5>{{ $name }}</h5>
                                    <p>{{ $award }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <p class="text-center mt-3" style="color:#555;font-size:.78rem;letter-spacing:.08em;">Hover to reveal</p>
        </div>

        {{-- Stats --}}
        <div data-aos="fade-left">
            <div class="team-text">
                <p class="eyebrow">By the Numbers</p>
                <h2><em>Excellence</em> in Every Detail</h2>
                <p>Our team brings decades of combined experience to every plate, driven by an unwavering commitment to quality and creativity.</p>
            </div>
            <div class="stats-grid">
                @foreach([
                    ['25',  'years of combined culinary expertise'],
                    ['500', 'unique dishes created annually'],
                    ['32',  'specialty dishes on our menu'],
                    ['87',  'awards from culinary competitions'],
                ] as [$num, $label])
                <div class="stat-box">
                    <span class="count" data-target="{{ $num }}">0</span>
                    <p>{{ $label }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 650, once: true });

    // Count-up animation — triggered saat elemen masuk viewport
    const counters = document.querySelectorAll('.count[data-target]');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (!entry.isIntersecting) return;
            observer.unobserve(entry.target);
            const target = +entry.target.dataset.target;
            const step   = Math.ceil(target / 60);
            let current  = 0;
            const tick = () => {
                current = Math.min(current + step, target);
                entry.target.textContent = current;
                if (current < target) requestAnimationFrame(tick);
            };
            tick();
        });
    }, { threshold: .3 });

    counters.forEach(el => observer.observe(el));
</script>

@endsection

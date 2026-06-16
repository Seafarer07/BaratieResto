@extends('web.layout.nav')
@section('title', 'Menu — Baratie Resto')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600,700i&display=swap" rel="stylesheet">

<style>
    body { background-color: #1a1a1a; font-family: 'Playfair Display', serif; color: #eaeaea; }

    /* ── Page Header ── */
    .page-header {
        text-align: center;
        padding: 60px 0 20px;
    }
    .page-header .eyebrow {
        letter-spacing: .35em;
        font-size: .78rem;
        color: #d4af37;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .page-header h1 { font-size: 2.8rem; font-weight: 700; color: #fff; margin-bottom: 12px; }
    .page-header .lead { color: #888; font-size: .95rem; max-width: 520px; margin: 0 auto; }

    .gold-divider {
        display: flex; align-items: center; justify-content: center; gap: 12px;
        margin: 16px auto 0;
    }
    .gold-divider span { display: block; height: 1px; width: 80px; background: #d4af37; opacity: .5; }
    .gold-divider i { color: #d4af37; font-size: .7rem; }

    /* ── Category Nav ── */
    .cat-nav {
        display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;
        padding: 32px 0 8px;
    }
    .cat-nav a {
        display: inline-block;
        padding: 7px 22px;
        border: 1px solid rgba(212,175,55,.35);
        border-radius: 30px;
        color: #aaa;
        font-size: .8rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        text-decoration: none;
        transition: .2s;
    }
    .cat-nav a:hover, .cat-nav a.active {
        background: #d4af37;
        border-color: #d4af37;
        color: #111;
        font-weight: 700;
    }

    /* ── Section Heading ── */
    .section-heading {
        /* offset for fixed navbar (~65px) + breathing room */
        scroll-margin-top: 85px;
        padding-top: 48px;
        padding-bottom: 4px;
    }
    .section-heading h3 {
        font-size: 1.5rem;
        color: #d4af37;
        letter-spacing: .08em;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 0;
    }
    .section-heading h3::before,
    .section-heading h3::after {
        content: '';
        display: inline-block;
        width: 40px;
        height: 1px;
        background: rgba(212,175,55,.4);
    }

    /* ── Menu List ── */
    .menu-section { margin-top: 12px; }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 20px;
        border-bottom: 1px solid #252525;
        transition: background .2s;
        border-radius: 8px;
    }
    .menu-item:last-child { border-bottom: none; }
    .menu-item:hover { background: rgba(212,175,55,.05); }

    .menu-image {
        width: 70px; height: 70px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid rgba(212,175,55,.2);
        flex-shrink: 0;
    }
    .menu-details { flex: 1; text-align: left; }
    .menu-details strong { font-size: 1rem; color: #fff; display: block; margin-bottom: 3px; }
    .menu-details p { font-size: .85rem; color: #777; margin: 0; line-height: 1.5; }
    .menu-price {
        color: #d4af37;
        font-weight: 700;
        font-size: .95rem;
        white-space: nowrap;
        flex-shrink: 0;
    }

    @media (max-width: 576px) {
        .menu-item { flex-wrap: wrap; }
        .menu-price { width: 100%; text-align: right; }
    }

    /* ── CTA ── */
    .btn-gold-outline {
        border: 1px solid #d4af37;
        color: #d4af37;
        background: transparent;
        border-radius: 8px;
        padding: 11px 36px;
        font-family: 'Playfair Display', serif;
        font-size: .85rem;
        letter-spacing: .1em;
        text-transform: uppercase;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-gold-outline:hover { background: #d4af37; color: #111; }
</style>

{{-- Page Header --}}
<div class="page-header" data-aos="fade-down">
    <p class="eyebrow">Baratie Resto</p>
    <h1>Our Menu</h1>
    <p class="lead">Explore our curated selection of dishes, combining tradition with modern culinary techniques.</p>
    <div class="gold-divider">
        <span></span><i class="fa fa-cutlery"></i><span></span>
    </div>
</div>

{{-- Category Quick Nav --}}
<div class="cat-nav" data-aos="fade-up">
    <a href="#appetizer">Appetizer</a>
    <a href="#maincourse">Main Course</a>
    <a href="#dessert">Dessert</a>
    <a href="#drinks">Drinks</a>
</div>

<div class="container pb-5">

    {{-- ── Appetizer ── --}}
    <div id="appetizer" class="section-heading text-center" data-aos="fade-up">
        <h3>Appetizer</h3>
    </div>
    <div class="menu-section" data-aos="fade-up">
        @foreach([
            ['Garlic Bread',      68000,  'garlic-bread.jpeg', 'Crispy bread infused with fragrant garlic butter.'],
            ['Bruschetta',        72000,  'bruschetta.jpeg',   'Grilled bread topped with a mix of tomatoes, basil, and olive oil.'],
            ['Stuffed Mushrooms', 88000,  'mushrooms.jpeg',    'Mushroom caps filled with savory cheese and herbs.'],
            ['Chicken Wings',     68000,  'wings.jpeg',        'Spicy marinated wings served with a creamy dip.'],
            ['Spring Rolls',      42000,  'spring-rolls.jpeg', 'Crispy rolls filled with vegetables and shrimp.'],
        ] as $item)
        <div class="menu-item">
            <img src="{{ asset('public/images/' . $item[2]) }}" alt="{{ $item[0] }}" class="menu-image">
            <div class="menu-details">
                <strong>{{ $item[0] }}</strong>
                <p>{{ $item[3] }}</p>
            </div>
            <div class="menu-price">Rp {{ number_format($item[1], 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    {{-- ── Main Course ── --}}
    <div id="maincourse" class="section-heading text-center" data-aos="fade-up">
        <h3>Main Course</h3>
    </div>
    <div class="menu-section" data-aos="fade-up">
        @foreach([
            ['Grilled Salmon',  185000, 'salmon.jpeg',  'Perfectly grilled salmon served with sautéed vegetables.'],
            ['Wagyu Steak',     375000, 'wagyu.jpeg',   'Juicy and tender Wagyu beef with a side of mashed potatoes.'],
            ['Chicken Alfredo', 170000, 'alfredo.jpeg', 'Creamy pasta topped with grilled chicken and parmesan.'],
            ['Lamb Chops',      290000, 'lamb.jpeg',    'Succulent lamb chops with rosemary-infused gravy.'],
            ['Seafood Platter', 320000, 'seafood.jpeg', 'An assortment of grilled seafood with dipping sauces.'],
        ] as $item)
        <div class="menu-item">
            <img src="{{ asset('public/images/' . $item[2]) }}" alt="{{ $item[0] }}" class="menu-image">
            <div class="menu-details">
                <strong>{{ $item[0] }}</strong>
                <p>{{ $item[3] }}</p>
            </div>
            <div class="menu-price">Rp {{ number_format($item[1], 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    {{-- ── Dessert ── --}}
    <div id="dessert" class="section-heading text-center" data-aos="fade-up">
        <h3>Dessert</h3>
    </div>
    <div class="menu-section" data-aos="fade-up">
        @foreach([
            ['Chocolate Lava Cake', 75000, 'lava.jpeg',        'Warm cake with a gooey chocolate center.'],
            ['Panna Cotta',         62000, 'panna.jpeg',        'Smooth Italian dessert with a berry topping.'],
            ['Cheesecake',          65000, 'cheesecake.jpeg',   'Classic cheesecake with a graham cracker crust.'],
            ['Tiramisu',            72000, 'tiramisu.jpeg',     'Coffee-flavored Italian dessert with mascarpone.'],
            ['Creme Brulee',        80000, 'creme.jpeg',        'Creamy custard with a caramelized sugar top.'],
        ] as $item)
        <div class="menu-item">
            <img src="{{ asset('public/images/' . $item[2]) }}" alt="{{ $item[0] }}" class="menu-image">
            <div class="menu-details">
                <strong>{{ $item[0] }}</strong>
                <p>{{ $item[3] }}</p>
            </div>
            <div class="menu-price">Rp {{ number_format($item[1], 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    {{-- ── Drinks ── --}}
    <div id="drinks" class="section-heading text-center" data-aos="fade-up">
        <h3>Drinks</h3>
    </div>
    <div class="menu-section" data-aos="fade-up">
        @foreach([
            ['Cappuccino', 45000, 'cappuccino.jpeg', 'Rich espresso topped with steamed milk foam.'],
            ['Mojito',     54000, 'mojito.jpeg',     'Refreshing mint and lime cocktail with soda water.'],
            ['Iced Tea',   22000, 'iced-tea.jpeg',   'Classic iced tea with a hint of lemon.'],
            ['Lemonade',   29000, 'lemonade.jpeg',   'Fresh lemon juice with a touch of sweetness.'],
            ['Smoothie',   57000, 'smoothie.jpeg',   'Blended fruits and yogurt for a healthy drink.'],
        ] as $item)
        <div class="menu-item">
            <img src="{{ asset('public/images/' . $item[2]) }}" alt="{{ $item[0] }}" class="menu-image">
            <div class="menu-details">
                <strong>{{ $item[0] }}</strong>
                <p>{{ $item[3] }}</p>
            </div>
            <div class="menu-price">Rp {{ number_format($item[1], 0, ',', '.') }}</div>
        </div>
        @endforeach
    </div>

    {{-- CTA --}}
    <div class="text-center mt-5" data-aos="fade-up">
        <a href="https://drive.google.com/file/d/1dPsJmB775zeHPS7iqftCUMJBI2cS05IR/view"
           class="btn-gold-outline" target="_blank">View Full Menu (PDF)</a>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });

    // Highlight active category pill saat scroll
    const sections = ['appetizer','maincourse','dessert','drinks'];
    const links    = document.querySelectorAll('.cat-nav a');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                links.forEach(l => l.classList.remove('active'));
                const active = document.querySelector(`.cat-nav a[href="#${entry.target.id}"]`);
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-30% 0px -60% 0px' });

    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) observer.observe(el);
    });
</script>

@endsection

@extends('web.layout.nav')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menu - Baratie Resto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600&display=swap" rel="stylesheet" />

    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
</head>

<style>
    body {
        background-color: #1a1a1a;
        font-family: 'Playfair Display', serif;
        color: #eaeaea;
        margin: 0;
        padding: 0;
    }

    h1, h3 {
        color: #d4af37;
    }

    .section {
        margin-top: 50px;
    }

    .menu-item {
        border-bottom: 1px solid #555;
        padding: 15px 0;
        display: flex;
        align-items: center;
    }

    .menu-item:last-child {
        border-bottom: none;
    }

    .menu-image {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        margin-right: 15px;
        object-fit: cover;
    }

    .menu-details {
        flex: 1;
    }

    .menu-price {
        color: #d4af37;
        font-weight: bold;
        margin-left: 20px;
    }

    .btn-outline-light {
        border-color: #d4af37;
        color: #d4af37;
        border-radius: 5px;
        padding: 8px 20px;
        font-size: 1rem;
        height: 45px;
        transition: all 0.3s ease-in-out;
    }

    .btn-outline-light:hover {
        background-color: #d4af37;
        color: black;
    }

    @media (max-width: 576px) {
        .menu-price {
            margin-left: 0;
            margin-top: 10px;
        }

        .menu-item {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    .btn-outline-dark {
        background-color: #1a1a1a;
        border: 1px solid #d4af37;
        color: #d4af37;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .btn-outline-dark:hover {
        background-color: #d4af37;
        color: black;
    }
</style>

<div class="container text-center my-5" data-aos="fade-up">
    <h1>Our Menu</h1>
    <p class="lead">Explore our curated selection of dishes, combining tradition with modern culinary techniques.</p>

    <!-- Appetizer Section -->
    <div id="appetizer" class="section" data-aos="fade-up">
        <h3>Appetizer</h3>
        @foreach([
            ['Garlic Bread', 68000, 'garlic-bread.jpeg', 'Crispy bread infused with fragrant garlic butter.'],
            ['Bruschetta', 72000, 'bruschetta.jpeg', 'Grilled bread topped with a mix of tomatoes, basil, and olive oil.'],
            ['Stuffed Mushrooms', 88000, 'mushrooms.jpeg', 'Mushroom caps filled with savory cheese and herbs.'],
            ['Chicken Wings', 68000, 'wings.jpeg', 'Spicy marinated wings served with a creamy dip.'],
            ['Spring Rolls', 42000, 'spring-rolls.jpeg', 'Crispy rolls filled with vegetables and shrimp.']
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

    <!-- Main Course Section -->
    <div id="maincourse"class="section" data-aos="fade-up">
        <h3>Main Course</h3>
        @foreach([
            ['Grilled Salmon', 185000, 'salmon.jpeg', 'Perfectly grilled salmon served with sautéed vegetables.'],
            ['Wagyu Steak', 375000, 'wagyu.jpeg', 'Juicy and tender Wagyu beef with a side of mashed potatoes.'],
            ['Chicken Alfredo', 170000, 'alfredo.jpeg', 'Creamy pasta topped with grilled chicken and parmesan.'],
            ['Lamb Chops', 290000, 'lamb.jpeg', 'Succulent lamb chops with rosemary-infused gravy.'],
            ['Seafood Platter', 320000, 'seafood.jpeg', 'An assortment of grilled seafood with dipping sauces.']
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

    <!-- Dessert Section -->
    <div id="dessert" class="section" data-aos="fade-up">
        <h3>Dessert</h3>
        @foreach([
            ['Chocolate Lava Cake', 75000, 'lava.jpeg', 'Warm cake with a gooey chocolate center.'],
            ['Panna Cotta', 62000, 'panna.jpeg', 'Smooth Italian dessert with a berry topping.'],
            ['Cheesecake', 65000, 'cheesecake.jpeg', 'Classic cheesecake with a graham cracker crust.'],
            ['Tiramisu', 72000, 'tiramisu.jpeg', 'Coffee-flavored Italian dessert with mascarpone.'],
            ['Creme Brulee', 80000, 'creme.jpeg', 'Creamy custard with a caramelized sugar top.']
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

    <!-- Drinks Section -->
    <div id="drinks" class="section" data-aos="fade-up">
        <h3>Drinks</h3>
        @foreach([
            ['Cappuccino', 45000, 'cappuccino.jpeg', 'Rich espresso topped with steamed milk foam.'],
            ['Mojito', 54000, 'mojito.jpeg', 'Refreshing mint and lime cocktail with soda water.'],
            ['Iced Tea', 22000, 'iced-tea.jpeg', 'Classic iced tea with a hint of lemon.'],
            ['Lemonade', 29000, 'lemonade.jpeg', 'Fresh lemon juice with a touch of sweetness.'],
            ['Smoothie', 57000, 'smoothie.jpeg', 'Blended fruits and yogurt for a healthy drink.']
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

    <div class="text-start" style="display: flex; justify-content: center;">
        <a href="https://drive.google.com/file/d/1dPsJmB775zeHPS7iqftCUMJBI2cS05IR/view">
            <button type="button" class="btn btn-outline-dark" style="padding: 10px 40px; margin-top: 20px">View All Menu</button>
        </a>
    </div>

</div>

<script>
    AOS.init();
</script>

@endsection
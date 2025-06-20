@extends('web.layout.nav')

@section('content')

<head>
    <title>About - Baratie Resto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Playfair+Display:400,600&display=swap" rel="stylesheet" />

    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Playfair Display', serif;
            color: #eaeaea;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #d4af37;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(-20px);
            animation: fadeInUp 0.5s forwards;
        }

        /* Achievement Card Styles */
        .achievement-card {
            background-color: #1a1a1a;
            border-radius: 15px;
            color: white;
            padding: 20px;
            text-align: center;
            margin: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        .achievement-card img {
            width: 50px;
            height: 50px;
        }

        .achievement-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        /* Chef Flip Card Styles */
        .flip-card {
            background-color: transparent;
            width: 200px; /* Fixed width */
            height: 300px; /* Fixed height */
            perspective: 1000px; /* Adds depth to the flip effect */
            margin: 15px; /* Gap between cards */
        }

        .flip-card-inner {
            position: relative;
            width: 80%;
            height: 80%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg); /* Rotate around Y-axis */
        }

        .flip-card-front,
        .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 15px;
            overflow: hidden;
        }

        .flip-card-front {
            background-color: #1a1a1a;
            color: white;
        }

        .flip-card-back {
            background-color: #333; /* Different color for the back */
            color: #d4af37; /* Gold color for text on the back */
            transform: rotateY(180deg);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .chef-image {
            width: 100%;
            height: 100%;
            gap: 10px;
            object-fit: cover;
            border-radius: 15px; /* Rounded corners */
        }

        /* Story Image Styling */
        .story img {
            width: 80%;
            height: auto;
            margin: 0 auto;
            display: block;
        }

        /* Chef Section H2 Color */
        .chef-section h2 {
            color: #d4af37; /* Change h2 color to gold */
        }

        /* Change the color of the count numbers */
        .count {
            color: #d4af37; /* Gold color for the count numbers */
        }

        /* Keyframes for FadeIn */
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .achievement-card {
                width: 80%;
                margin: 5px auto;
            }
        }
    </style>
</head>

<!-- Story Section -->
<div class="container my-5 text-center">
    <h1>About Us</h1>
    <p class="lead text-justify" style="font-size: 1.5rem;">
        Welcome to Baratie Resto, a place where culinary taste and warm atmosphere combine into one. Founded with a passion for serving high quality food that combines rich traditional flavors and modern innovation, 
        Baratie Resto is the main destination for culinary lovers who want an unforgettable dining experience.
    </p>
    <p class="lead text-justify" style="font-size: 1.5rem;">
    At Baratie Resto, we believe that every dish has a story. Therefore, we are proud to serve a variety of dishes inspired from local culture to international flavors, all prepared with the freshest ingredients and the best cooking techniques.
    </p>
</div>

<div class="story">
    <img src="{{ asset('public/images/head(1).jpg') }}">
</div>

<!-- Achievements Section -->
<div class="container my-5 text-center">
    <h1>Achievements</h1>
    <div class="row justify-content-center">
        @foreach ([ 
            ['image' => 'star.png', 'title' => 'Michelin Star 2023'],
            ['image' => 'star.png', 'title' => 'Best Dessert 2022'],
            ['image' => 'star.png', 'title' => 'James Beard Awards 2023']
        ] as $achievement)
            <div class="col-4 d-flex justify-content-center mb-4">
                <div class="achievement-card">
                    <img src="{{ asset('public/images/' . $achievement['image']) }}" alt="Achievement">
                    <h2 style="font-size: 1.2rem;">{{ $achievement['title'] }}</h2>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Executive Chef Section -->
<div class="container my-5">
    <div class="row">
        <!-- Left side: Chef images -->
        <div class="col-md-6 d-flex flex-column align-items-center">
            <div class="row">
                @foreach([
                    ['image' => 'person1.jpeg', 'name' => 'Ateng', 'achievement' => 'Best Chef Award 2023'],
                    ['image' => 'person2.jpeg', 'name' => 'Cece', 'achievement' => 'Culinary Innovator 2022'],
                    ['image' => 'person3.jpeg', 'name' => 'Jembung', 'achievement' => 'Sustainable Cooking Award 2023']
                ] as $chef)
                    <div class="col-4 mb-4">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="flip-card-front">
                                    <img src="{{ asset('public/images/' . $chef['image']) }}" class="chef-image" alt="{{ $chef['name'] }}">
                                </div>
                                <div class="flip-card-back">
                                    <div>
                                        <h2>{{ $chef['name'] }}</h2>
                                        <p>{{ $chef['achievement'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right side: Chef details -->
        <div class="col-md-6 chef-section">
            <h1 class="mb-4">The Team.</h1>
            <p class="lead mb-4">Meet our talented chefs who craft unforgettable culinary experiences.</p>
            <div class="row text-center">
                <div class="col-6 mb-4">
                    <h2 class="count" data-count="25">0</h2>
                    <p>years of combined culinary expertise</p>
                </div>
                <div class="col-6 mb-4">
                    <h2 class="count" data-count="500">0</h2>
                    <p>unique dishes created annually</p>
                </div>
                <div class="col-6 mb-4">
                    <h2 class="count" data-count="32">0</h2>
                    <p>specialty dishes on our menu</p>
                </div>
                <div class="col-6 mb-4">
                    <h2 class="count" data-count="87">0</h2>
                    <p>awards from culinary competitions</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Animation for counting up numbers
    const counters = document.querySelectorAll('.count');
    const speed = 100; // Adjust this value to change the speed

    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-count');
            const count = +counter.innerText;

            const increment = target / speed;

            if (count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 30);
            } else {
                counter.innerText = target;
            }
        };

        // Trigger the counter animation when the element comes into view
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCount();
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(counter);
    });
</script>

@endsection
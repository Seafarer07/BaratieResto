@extends('web.layout.nav')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review - Baratie Resto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

    <style>
        body {
            background-color: #1a1a1a;
            font-family: 'Playfair Display', serif;
            color: #eaeaea;
        }

        h1 {
            color: #d4af37;
            text-align: center;
            margin-bottom: 20px;
        }

        .bg-glass {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: saturate(150%) blur(30px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-review {
            background-color: #2a2a2a;
            border: 1px solid #d4af37;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .star {
            font-size: 1.8rem;
            cursor: pointer;
            color: gray;
        }

        .star.active {
            color: gold;
        }

        .star-display {
            color: gold;
            font-size: 1.2rem;
        }
    </style>
</head>

<div class="container my-5" data-aos="fade-up">
    <h1>Customer Review</h1>

    <!-- Review Form -->
    <div class="bg-glass mb-5">
        <h4 class="mb-4">Leave Your Review</h4>
        <form action="{{ route('review.store') }}" method="POST">
            @csrf

            <!-- Dropdown Kategori -->
            <div class="mb-3">
                <label for="kategori" class="form-label">Select Category</label>
                <select class="form-control" id="kategori" name="kategori" onchange="filterMenus()">
                    <option value="" selected>-- Choose a Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category }}" {{ $selectedCategory == $category ? 'selected' : '' }}>
                            {{ ucfirst($category) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Menu -->
            <div class="mb-3">
                <label for="id_menu" class="form-label">Select Menu</label>
                <select class="form-control" id="id_menu" name="id_menu" required>
                    <option value="" disabled selected>-- Choose a Menu --</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}">
                            {{ $menu->nama_menu }} - Rp{{ number_format($menu->harga, 0, ',', '.') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Review Input -->
            <div class="mb-3">
                <label for="note" class="form-label">Review</label>
                <textarea class="form-control" id="note" name="note" rows="3" placeholder="Share your experience..." required></textarea>
            </div>

            <!-- Star Rating -->
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <div id="star-rating" style="font-size: 1.8rem; cursor: pointer;">
                    @for ($i = 1; $i <= 5; $i++)
                        <span class="star" data-value="{{ $i }}">&#9733;</span>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Review</button>
        </form>
    </div>

    <!-- Review List -->
    @forelse ($reviews as $review)
        <div class="card-review" data-aos="fade-up">
            <div class="d-flex align-items-center mb-2">
                <img src="{{ $review->user->gambar ?? asset('images/default.png') }}" 
                     class="profile-img me-3" alt="User">
                <div>
                    <h5>{{ $review->user->nama ?? 'Anonymous' }}</h5>
                </div>
            </div>
            <p>
                <strong>Menu:</strong> {{ $review->menu->nama_menu ?? 'Unknown Menu' }} 
                - <strong>Rp{{ number_format($review->menu->harga ?? 0, 0, ',', '.') }}</strong>
            </p>
            <p><strong>Rating:</strong> 
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $review->rating)
                        <span class="star-display">&#9733;</span>
                    @else
                        <span class="star-display text-muted">&#9733;</span>
                    @endif
                @endfor
            </p>
            <p>{{ $review->note }}</p>
        </div>
    @empty
        <p class="text-center">No reviews available. Be the first to leave a review!</p>
    @endforelse

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</div>

<script>
    function filterMenus() {
        const selectedCategory = document.getElementById('kategori').value;
        const url = new URL(window.location.href);
        url.searchParams.set('kategori', selectedCategory);
        window.location.href = url.toString();
    }

    // Star Rating Interaction
    const stars = document.querySelectorAll('#star-rating .star');
    const ratingInput = document.getElementById('rating');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            ratingInput.value = value;

            stars.forEach(s => {
                s.classList.toggle('active', s.getAttribute('data-value') <= value);
            });
        });
    });

    AOS.init(); // Initialize AOS Animation Library
</script>

@endsection
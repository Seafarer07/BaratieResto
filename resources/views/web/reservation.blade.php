@extends('web.layout.nav')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation - Baratie Resto</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet" />
</head>

<style>
    body {
        background-color: #000;
        color: #eaeaea;
        font-family: 'Playfair Display', serif;
        margin: 0;
        padding: 0;
    }

    .container {
        margin-top: 50px;
        padding: 30px;
    }

    .bg-glass {
        background-color: rgba(255, 255, 255, 0.1);
        backdrop-filter: saturate(150%) blur(30px);
        border-radius: 15px;
        padding: 30px;
    }

    .form-control, .form-select {
        background-color: #333;
        color: white;
        border: 1px solid #444;
        transition: border-color 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #d4af37;
        box-shadow: none;
    }

    h1 {
        color: #d4af37;
        text-align: center;
        margin-bottom: 20px;
    }

    p {
        text-align: center;
        margin-bottom: 30px;
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
</style>

<div class="container">
    <div class="bg-glass" data-aos="fade-up">
        <h1>Reservation Form</h1>
        <p>Send us a message and we'll get back to you as soon as possible. Looking forward to hearing from you.</p>

        <!-- Pesan Sukses atau Error -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Menampilkan pesan error dari validasi -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



       <!-- Form Reservasi -->
        <form action="{{ route('reservasi.store') }}" method="POST" novalidate>
            @csrf

            <!-- Nama User -->
            <div class="mb-4">
                <label for="user" class="form-label">Name</label>
                <input type="text" class="form-control" id="user" name="name" 
                    value="{{ Auth::check() ? Auth::user()->nama_pelanggan : '' }}" 
                    placeholder="Name" readonly>
            </div>

            <!-- Input Hidden untuk id_user -->
            <input type="hidden" name="id_user" value="{{ Auth::id() }}">

            <!-- Nomor Telepon -->
            <div class="mb-4">
                <label for="phoneInput" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phoneInput" name="phone" 
                    value="{{ Auth::check() ? Auth::user()->telepon : '' }}" 
                    placeholder="Phone Number" readonly>
            </div>

            <!-- Pilih Jenis Meja -->
            <div class="mb-4">
                <label for="tableSelect" class="form-label">Table</label>
                <select class="form-select" id="tableSelect" name="jenis" required>
                    <option selected value="">Select Table</option>
                    <option value="Reguler">Reguler (2)</option>
                    <option value="VIP">VIP (4)</option>
                    <option value="VVIP">VVIP (8)</option>
                </select>
                <div class="invalid-feedback">Please select a table type.</div>
            </div>

            <!-- Tanggal Reservasi -->
            <div class="mb-4">
                <label for="dateInput" class="form-label">Date</label>
                <input type="date" class="form-control" id="dateInput" name="tanggal_reservasi"
                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
                <div class="invalid-feedback">Please select a date in the future.</div>
            </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="noteInput" class="form-label">Note</label>
                <textarea class="form-control" id="noteInput" name="note" rows="3" placeholder="Add any special requests"></textarea>
            </div>

            <!-- Tombol Submit -->
            @auth
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-light w-100">Submit</button>
                </div>
            @else
                <div class="text-center">
                    <a href="{{ route('web.login') }}" class="btn btn-outline-light w-100">Login to Make a Reservation</a>
                </div>
            @endauth
        </form>
    </div>
</div>

<script>
    AOS.init();
</script>

@endsection
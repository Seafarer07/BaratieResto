@extends('admin.sidebar')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah User - Baratie Resto</title>

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

    h1, h5 {
        color: #d4af37;
    }

    .card {
        background-color: #2a2a2a;
        border: 1px solid #d4af37;
        color: #eaeaea;
        border-radius: 10px;
        overflow: hidden;
    }

    .card-header {
        background-color: #d4af37;
        color: #1a1a1a;
        font-weight: bold;
    }

    .btn-success {
        background-color: #d4af37;
        border-color: #d4af37;
        color: #1a1a1a;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #b89e2f;
        border-color: #b89e2f;
    }

    label {
        font-weight: bold;
    }

    .form-control {
        background-color: #333;
        color: #eaeaea;
        border: 1px solid #555;
    }

    .form-control::placeholder {
        color: #999;
    }

    .form-control:focus {
        border-color: #d4af37;
        box-shadow: 0 0 5px #d4af37;
    }

    .invalid-feedback {
        color: #ff4d4d;
    }

    .text-judul{
        color: #d4af37;
        font-size: 4rem;
    }
</style>

<div class="container my-5" data-aos="fade-up">
    <div class="content-header">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="text-judul">Tambah User</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h5>Form Tambah User</h5>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h4 class="mb-4 text-center">REGISTER</h4>

    <!-- Upload Gambar -->
    <div class="form-floating mb-3">
        <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
        <label for="gambar">Upload Gambar</label>
        @error('gambar')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Nama User -->
    <div class="form-floating mb-3">
        <input type="text" class="form-control @error('nama_pelanggan') is-invalid @enderror" id="nama_pelanggan" name="nama_pelanggan" placeholder="Masukkan Nama User" required>
        <label for="nama_pelanggan">Nama User</label>
        @error('nama_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Telepon -->
    <div class="form-floating mb-3">
        <input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" placeholder="Masukkan Telepon User" pattern="[0-9]{10,15}" required>
        <label for="telepon">Nomor Telepon</label>
        @error('telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="form-floating mb-3">
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan Email" required>
        <label for="email">Email</label>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-floating mb-3">
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Masukkan Password" required>
        <label for="password">Password</label>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Submit & Cancel Buttons -->
    <div class="d-flex justify-content-between">
        <button type="reset" class="btn btn-secondary" style="width: 48%;">Cancel</button>
        <button type="submit" class="btn btn-success" style="width: 48%;">
            <i class="fa-solid fa-floppy-disk"></i> Simpan
        </button>
    </div>
</form>

        </div>
    </div>
</div>

<script>
    AOS.init();
</script>

@endsection

@extends('admin.sidebar')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Meja - Baratie Resto</title>

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
                <h1 class="text-judul">Tambah Meja</h1>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h5>Form Tambah Meja</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('meja.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select class="form-control @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                            <option value="" selected disabled>Pilih jenis meja</option>
                            <option value="Reguler">Reguler (2 Person)</option>
                            <option value="VIP">VIP (4 Person)</option>
                            <option value="VVIP">VVIP (8 Person)</option>
                        </select>
                        @error('jenis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
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

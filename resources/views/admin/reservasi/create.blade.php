@extends('admin.sidebar')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Reservasi - Baratie Resto</title>

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

    label {
        font-weight: bold;
        color: #d4af37;
    }

    .form-control {
        background-color: #333;
        color: #eaeaea;
        border: 1px solid #555;
        border-radius: 8px;
    }

    .form-control::placeholder {
        color: #999;
    }

    .form-control:focus {
        border-color: #d4af37;
        box-shadow: 0 0 5px #d4af37;
    }

    .card {
        background-color: #2a2a2a;
        border: 1px solid #d4af37;
        border-radius: 10px;
        color: #eaeaea;
    }

    .card-header {
        background-color: #d4af37;
        color: #1a1a1a;
        font-weight: bold;
    }

    .btn-success {
        background-color: #d4af37;
        border: none;
        color: #1a1a1a;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        background-color: #b89e2f;
        color: #1a1a1a;
    }
</style>

<div class="container my-5" data-aos="fade-up">
    <div class="content-header">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h1 class="mb-0">Tambah Reservasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center">
            <h5>Form Tambah Reservasi</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="id_user">Pilih User</label>
                        <select class="form-control @error('id_user') is-invalid @enderror" id="id_user" name="id_user">
                            <option value="" selected disabled>Pilih Pelanggan</option>
                            @foreach (\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->nama_pelanggan }}</option>
                            @endforeach
                        </select>
                        @error('id_user')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="jenis">Pilih Jenis Meja</label>
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

                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="tanggal_reservasi">Tanggal Reservasi</label>
                        <input type="date" class="form-control @error('tanggal_reservasi') is-invalid @enderror" id="tanggal_reservasi" name="tanggal_reservasi">
                        @error('tanggal_reservasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="note">Catatan</label>
                        <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note" placeholder="Masukkan catatan">
                        @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-floppy-o"></i> Simpan
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

@extends('web.layout.nav')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
</head>

<style>
    body {
        background-color: #1a1a1a;
        font-family: 'Playfair Display', serif;
        color: #eaeaea;
        margin: 0;
        padding: 0;
    }

    /* Layout utama */
    .container-profile {
        display: flex;
        justify-content: center;
        gap: 20px;
        /* Jarak antar kolom */
        margin-top: 50px;
    }

    /* Bagian Kiri - Profil */
    /* .profile-left, .profile-center, .profile-right {
        flex-basis: 30%;
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    } */

    .profile-left {
        flex-basis: 30%;
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-center {
        flex-basis: 50%;
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Flex untuk menata isi dari tiap kolom */
    .profile-left img,
    .profile-right img {
        border-radius: 50%;
        width: 250px;
        height: 250px;
        display: block;
        margin: 0 auto;
    }

    .profile-left h5 {
        text-align: left;
        margin-top: 15px;
        font-weight: 600;
    }

    .profile-left p {
        text-align: left;
        color: #777;
    }

    .btn-primary {
        background-color: #1a1a1a;
        border: 1px solid #d4af37;
        color: #d4af37;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #d4af37;
        color: black;
    }


    .btn-cancel {
        background-color: #1a1a1a;
        border: 1px solid whitesmoke;
        color: whitesmoke;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .btn-cancel:hover {
        background-color: whitesmoke;
        color: black;
    }


    .about-me h5 {
        font-weight: 600;
        color: whitesmoke;
    }

    .about-me p {
        color: #eaeaea;
    }

    /* Atur tinggi konten agar rata */
    .profile-left,
    .profile-center,
    .profile-right {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .about-me {
        padding: 20px;
    }

    .history-item {
        background-color: #333;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .history-item h5,
    .history-item p {
        margin: 0;
    }

    .history-item p {
        font-weight: bold;
    }

    /* form */
    .form-floating input {
        border-radius: 10px;
        background-color: whitesmoke;
        height: 20px;
    }

    .form-floating label {
        color: black;
    }
</style>

<!-- Container for Profile -->
<div class="container container-profile">
    <!-- Bagian Kiri - Profil -->
    <!-- Bagian Kiri - Profil -->
    <div class="profile-left">
        <img src="{{ asset($user->gambar) }}" alt="Profile Image">
        <div class="about-me">
            <h5>Nama Lengkap:</h5>
            <p>{{ $user->nama_pelanggan }}</p>
            
            <h5>Email:</h5>
            <p>{{ $user->email }}</p>

            <h5>No Telepon:</h5>
            <p>{{ $user->telepon }}</p>

            <!-- Tombol Logout -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" style="width: 48%;">
                    Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Bagian Tengah - Profile Detail -->
    <div class="profile-center">
        <h2><b>Edit Profile</b></h2>
        <br>

        @if(isset($user) && $user->id)
            <form action="{{ route('profile.update', $user->id) }}" method="POST">

                @csrf
                @method('PUT')
                <div class="form-floating mb-4">
                    <input type="text" class="form-control" name="nama_pelanggan" value="{{ $user->nama_pelanggan }}"
                        required />
                    <label for="nama_pelanggan">Nama Lengkap</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" required />
                    <label for="email">Email</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="tel" class="form-control" name="telepon" value="{{ $user->telepon }}" required />
                    <label for="telepon">Nomor Telepon</label>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="reset" class="btn btn-cancel" style="width: 48%;">Cancel</button>
                    <button type="submit" class="btn btn-primary" style="width: 48%;">Update</button>
                </div>
            </form>
        @else
            <p>User tidak ditemukan. Pastikan Anda sudah login.</p>
        @endif     
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDMNeT87bh950GNyZPhcTNXj1W7RuBCsyN/o@jlpcV8Qyq46cDFL" crossorigin="anonymous">
    </script>

@endsection
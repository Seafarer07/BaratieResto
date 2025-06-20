@extends('admin.sidebar')
@section('content')

<style>

    body{
        font-family: 'Playfair Display', serif;
    }

    .container-fluid{
        padding: 0;
        margin-left: 10px;
    }

  .gambar {
    height: 100px;
    border-radius: 100px;
    border: 2px solid #ddd;
    background-image: none;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }

  .gambarKelas {
    width: 100px;
    border-radius: 10px;
    border: 2px solid #ddd;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }

  .card {
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    border: 0;
    background-color:#d4af37;
    color: whitesmoke;
    height: auto;
    width: 3rem;
    overflow: hidden;
    margin: 1.5rem;
  }

  .card  {
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    border: 0;
    background-color:#d4af37;
    color: whitesmoke;
    height: auto;
    overflow: hidden;
  }

  .card-body {
    padding-left: 10px;
    width: 100%;
  }

  .card:hover {
    transform: scale(1.03);
  }

  .rating-icon {
    color: Gold;
  }

  .table {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
  }

  .table th {
    background-color: #d4af37;
    color: whitesmoke;
    text-align: center;
  }

  .table td {
    align-items: center;
    justify-content: center;
    padding: 15px;
    background-color: whitesmoke;
    color: #1a1a1a;
  }

  .container-fluid i{
    font-size: 200px;
  }

  .pagination .page-link {
        color: #d4af37;
        background-color: #2a2a2a;
        border: 1px solid #d4af37;
        margin: 0 5px;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: bold;
    }

    .pagination .page-link:hover {
        background-color: #d4af37;
        color: #1a1a1a;
        border-color: #d4af37;
    }

    .pagination .active .page-link {
        background-color: #d4af37;
        color: #1a1a1a;
        border-color: #d4af37;
    }

  .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }
</style>

<div class="container my-5" data-aos="fade-up">

    <!-- Dashboard Cards -->
    <div class="container-fluid">
    <b><h1> Dashboard </h1></b>
    <div class="medal">
        <div class="row row-cols-1 row-cols-sm-4 d-flex justify-content-center">

            <!-- Card Pengguna -->
            <div class="card shadow-lg">
                <div class="row row-cols-2 align-items-center">
                    <div class="card-body" style="padding-left:2rem;">
                        <h3>Pengguna</h3>
                        <h2 class="count" data-count="{{ \App\Models\User::count() }}" style="font-size:5rem;">0</h2>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <i class="fa-solid fa-user fa-5x" style="color:rgb(255, 231, 152);"></i>
                    </div>
                </div>
            </div>

            <!-- Card Reservasi -->
            <div class="card shadow-lg">
                <div class="row row-cols-2 align-items-center">
                    <div class="card-body" style="padding-left:2rem;">
                        <h3>Reservasi</h3>
                        <h2 class="count" data-count="{{ \App\Models\Reservasi::count() }}" style="font-size:5rem;">0</h2>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <i class="fa-solid fa-file fa-5x" style="color: rgb(255, 231, 152);"></i>
                    </div>
                </div>
            </div>

            <!-- Card Menu -->
            <div class="card shadow-lg">
                <div class="row row-cols-2 align-items-center">
                    <div class="card-body" style="padding-left:2rem;">
                        <h3>Menu</h3>
                        <h2 class="count" data-count="{{ \App\Models\Menu::count() }}" style="font-size:5rem;">0</h2>
                    </div>
                    <div class="col d-flex justify-content-center">
                        <i class="fa-solid fa-utensils fa-5x" style="color: rgb(255, 231, 152);"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

    <!-- Akun Pengguna -->
    <h2 class="text-judul">Akun Pengguna</h2>
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
            </tr>
        </thead>
        <tbody>
            @php
                $users = \App\Models\User::paginate(5);
            @endphp
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->nama_pelanggan }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telepon }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

    <!-- Menu -->
    <h2 class="text-judul mt-5">Menu</h2>
    <table class="table table-striped table-hover text-center">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Makanan</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            @php
                $menus = \App\Models\Menu::paginate(5);
            @endphp
            @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->nama_menu }}</td>
                <td>{{ $menu->kategori }}</td>
                <td>Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->nama_menu }}" class="img-thumbnail" style="width: 100px;">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $menus->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Script untuk animasi angka count -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const counters = document.querySelectorAll('.count');
        const speed = 200;

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
            updateCount();
        });
    });
</script>

@endsection

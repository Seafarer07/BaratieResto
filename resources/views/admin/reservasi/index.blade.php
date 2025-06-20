@extends('admin.sidebar')
@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - Baratie Resto</title>

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

    table {
        background-color: #2a2a2a;
        color: #eaeaea;
        border-radius: 10px;
        overflow: hidden;
    }

    thead {
        background-color: #d4af37;
        color: #1a1a1a;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    .btn-outline-light {
        border-color: #d4af37;
        color: #d4af37;
        transition: all 0.3s ease;
    }

    .btn-outline-light:hover {
        background-color: #d4af37;
        color: #1a1a1a;
    }

    .btn-light {
        background-color: #d4af37;
        color: whitesmoke;
        transition: all 0.3s ease;
    }

    .btn-light:hover {
        border-color: #d4af37;
        background-color: whitesmoke;
        color: #1a1a1a;
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

<div class="container text-left my-5" data-aos="fade-up">
    <h1 class="mb-3">Kelola Reservasi</h1>

    <div class="text-start mb-3">
        <a href="{{ route('reservasi.create') }}" class="btn btn-outline-light">Tambah Reservasi</a>
    </div>

    <!-- Reservasi Table -->
    <div class="table-responsive" data-aos="fade-up">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id Reservasi</th>
                    <th>Nama</th>
                    <th>Tanggal Reservasi</th>
                    <th>Nomor Meja</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservasi as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['id_user'] }}</td>
                    <td>{{ $item['tanggal_reservasi'] }}</td>
                    <td>{{ $item['id_meja'] }}</td>
                    <td>
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('reservasi.destroy', $item->id) }}" method="POST">
                            <a href="{{ route('reservasi.edit', $item->id) }}" class="btn btn-outline-light btn-sm">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-light btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Data reservasi belum tersedia</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination-container">
            {{ $reservasi->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<script>
    AOS.init();
</script>
@endsection

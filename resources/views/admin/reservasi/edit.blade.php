@extends('admin.sidebar')
@section('title', 'Edit Reservation')
@section('page-title', 'Edit <span>Reservation</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Edit Reservation</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('reservasi.index') }}">Reservations</a> / Edit #{{ $reservasi->id }}
        </div>
    </div>
    <a href="{{ route('reservasi.index') }}" class="btn-outline-gold">
        <i class="fa-solid fa-arrow-left"></i> Back
    </a>
</div>

@if($errors->any())
    <div class="a-alert a-alert-danger mb-3">
        <ul class="mb-0 ps-3">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="a-card" style="max-width:720px;">
    <div class="a-card-header">
        <h5>Reservation Details</h5>
    </div>
    <div class="a-card-body">
        <form action="{{ route('reservasi.update', $reservasi->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Guest <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="id_user" required>
                        <option value="" disabled>— Select guest —</option>
                        @foreach(\App\Models\User::orderBy('nama_pelanggan')->get() as $u)
                            <option value="{{ $u->id }}" {{ old('id_user', $reservasi->id_user) == $u->id ? 'selected' : '' }}>
                                {{ $u->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_user')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Table Type <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="jenis" required>
                        <option value="" disabled>— Select type —</option>
                        @php $currentJenis = optional($reservasi->meja)->jenis ?? old('jenis'); @endphp
                        <option value="Reguler" {{ $currentJenis == 'Reguler' ? 'selected' : '' }}>Reguler — 2 seats</option>
                        <option value="VIP"     {{ $currentJenis == 'VIP'     ? 'selected' : '' }}>VIP — 4 seats</option>
                        <option value="VVIP"    {{ $currentJenis == 'VVIP'    ? 'selected' : '' }}>VVIP — 8 seats</option>
                    </select>
                    @error('jenis')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="f-label">Reservation Date <span style="color:#d4af37">*</span></label>
                    <input type="date" class="f-control" name="tanggal_reservasi"
                           value="{{ old('tanggal_reservasi', $reservasi->tanggal_reservasi) }}"
                           style="color-scheme:dark;" required>
                    @error('tanggal_reservasi')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Special Request</label>
                    <input type="text" class="f-control" name="note"
                           value="{{ old('note', $reservasi->note) }}" placeholder="Special request…">
                    @error('note')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('reservasi.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

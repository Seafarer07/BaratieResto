@extends('admin.sidebar')
@section('title', 'Add Reservation')
@section('page-title', 'Add <span>Reservation</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Add Reservation</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('reservasi.index') }}">Reservations</a> / Add New
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
        <form action="{{ route('reservasi.store') }}" method="POST">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Guest <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="id_user" required>
                        <option value="" disabled {{ old('id_user') ? '' : 'selected' }}>— Select guest —</option>
                        @foreach(\App\Models\User::orderBy('nama_pelanggan')->get() as $u)
                            <option value="{{ $u->id }}" {{ old('id_user') == $u->id ? 'selected' : '' }}>
                                {{ $u->nama_pelanggan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_user')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Table Type <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="jenis" required>
                        <option value="" disabled {{ old('jenis') ? '' : 'selected' }}>— Select type —</option>
                        <option value="Reguler" {{ old('jenis') == 'Reguler' ? 'selected' : '' }}>Reguler — 2 seats</option>
                        <option value="VIP"     {{ old('jenis') == 'VIP'     ? 'selected' : '' }}>VIP — 4 seats</option>
                        <option value="VVIP"    {{ old('jenis') == 'VVIP'    ? 'selected' : '' }}>VVIP — 8 seats</option>
                    </select>
                    @error('jenis')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="f-label">Reservation Date <span style="color:#d4af37">*</span></label>
                    <input type="date" class="f-control" name="tanggal_reservasi"
                           value="{{ old('tanggal_reservasi') }}"
                           min="{{ \Carbon\Carbon::today()->toDateString() }}"
                           style="color-scheme:dark;" required>
                    @error('tanggal_reservasi')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Special Request</label>
                    <input type="text" class="f-control" name="note"
                           value="{{ old('note') }}" placeholder="e.g. Birthday dinner, window seat…">
                    @error('note')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('reservasi.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save Reservation
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

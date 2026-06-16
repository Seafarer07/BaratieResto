@extends('admin.sidebar')
@section('title', 'Edit Table')
@section('page-title', 'Edit <span>Table</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Edit Table</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('meja.index') }}">Tables</a> / Edit #{{ $meja->id }}
        </div>
    </div>
    <a href="{{ route('meja.index') }}" class="btn-outline-gold">
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

<div class="a-card" style="max-width:520px;">
    <div class="a-card-header">
        <h5>Table Details</h5>
    </div>
    <div class="a-card-body">
        <form action="{{ route('meja.update', $meja->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="f-label">Table Type <span style="color:#d4af37">*</span></label>
                <select class="f-control" name="jenis" required>
                    <option value="" disabled>— Choose table type —</option>
                    <option value="Reguler" {{ old('jenis', $meja->jenis) == 'Reguler' ? 'selected' : '' }}>Reguler — 2 seats</option>
                    <option value="VIP"     {{ old('jenis', $meja->jenis) == 'VIP'     ? 'selected' : '' }}>VIP — 4 seats</option>
                    <option value="VVIP"    {{ old('jenis', $meja->jenis) == 'VVIP'    ? 'selected' : '' }}>VVIP — 8 seats</option>
                </select>
                @error('jenis')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('meja.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

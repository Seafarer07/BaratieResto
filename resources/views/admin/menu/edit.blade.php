@extends('admin.sidebar')
@section('title', 'Edit Menu')
@section('page-title', 'Edit <span>Menu Item</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Edit Menu Item</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('menu.index') }}">Menu</a> / Edit
        </div>
    </div>
    <a href="{{ route('menu.index') }}" class="btn-outline-gold">
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
        <h5>Menu Details</h5>
    </div>
    <div class="a-card-body">
        <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Menu Photo</label>
                    @if($menu->image)
                        <img id="imgPreview" src="{{ asset($menu->image) }}" alt="Current"
                             style="display:block;margin-bottom:10px;width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid rgba(212,175,55,.3);">
                    @else
                        <img id="imgPreview" src="" alt="" style="display:none;margin-bottom:10px;width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid rgba(212,175,55,.3);">
                    @endif
                    <input type="file" class="f-control" name="image" accept="image/*"
                           onchange="previewImg(event)">
                    @error('image')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Menu Name <span style="color:#d4af37">*</span></label>
                    <input type="text" class="f-control" name="nama_menu"
                           value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                    @error('nama_menu')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="f-label">Category <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="jenis" required>
                        <option value="" disabled>— Choose category —</option>
                        @foreach(['Appetizer','Main Course','Dessert','Drink'] as $cat)
                            <option value="{{ $cat }}" {{ old('jenis', $menu->kategori) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('jenis')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Price (Rp) <span style="color:#d4af37">*</span></label>
                    <input type="number" class="f-control" name="harga"
                           value="{{ old('harga', $menu->harga) }}" min="0" required>
                    @error('harga')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('menu.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImg(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        const img = document.getElementById('imgPreview');
        img.src = ev.target.result;
        img.style.display = 'block';
    };
    reader.readAsDataURL(file);
}
</script>

@endsection

@extends('admin.sidebar')
@section('title', 'Add Menu')
@section('page-title', 'Add <span>Menu Item</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Add Menu Item</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('menu.index') }}">Menu</a> / Add New
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
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Menu Photo</label>
                    <input type="file" class="f-control" name="image" accept="image/*" id="imgInput"
                           onchange="previewImg(event)">
                    @error('image')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                    <img id="imgPreview" src="" alt="" style="display:none;margin-top:10px;width:100px;height:100px;object-fit:cover;border-radius:8px;border:1px solid rgba(212,175,55,.3);">
                </div>
                <div class="col-md-6">
                    <label class="f-label">Menu Name <span style="color:#d4af37">*</span></label>
                    <input type="text" class="f-control" name="nama_menu"
                           value="{{ old('nama_menu') }}" placeholder="e.g. Beef Rendang" required>
                    @error('nama_menu')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="f-label">Category <span style="color:#d4af37">*</span></label>
                    <select class="f-control" name="jenis" required>
                        <option value="" disabled {{ old('jenis') ? '' : 'selected' }}>— Choose category —</option>
                        @foreach(['Appetizer','Main Course','Dessert','Drink'] as $cat)
                            <option value="{{ $cat }}" {{ old('jenis') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('jenis')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Price (Rp) <span style="color:#d4af37">*</span></label>
                    <input type="number" class="f-control" name="harga"
                           value="{{ old('harga') }}" placeholder="e.g. 75000" min="0" required>
                    @error('harga')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end">
                <a href="{{ route('menu.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save Menu Item
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

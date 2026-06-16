@extends('admin.sidebar')
@section('title', 'Add User')
@section('page-title', 'Add <span>User</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Add User</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('user.index') }}">Users</a> / Add New
        </div>
    </div>
    <a href="{{ route('user.index') }}" class="btn-outline-gold">
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
        <h5>User Details</h5>
    </div>
    <div class="a-card-body">
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="f-label">Profile Photo</label>
                <input type="file" class="f-control" name="gambar" accept="image/*" id="imgInput"
                       onchange="previewImg(event)">
                <img id="imgPreview" src="" alt=""
                     style="display:none;margin-top:10px;width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid rgba(212,175,55,.4);">
                @error('gambar')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Full Name <span style="color:#d4af37">*</span></label>
                    <input type="text" class="f-control" name="nama_pelanggan"
                           value="{{ old('nama_pelanggan') }}" placeholder="Full name" required>
                    @error('nama_pelanggan')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Phone <span style="color:#d4af37">*</span></label>
                    <input type="tel" class="f-control" name="telepon"
                           value="{{ old('telepon') }}" placeholder="e.g. 081234567890" required>
                    @error('telepon')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Email <span style="color:#d4af37">*</span></label>
                    <input type="email" class="f-control" name="email"
                           value="{{ old('email') }}" placeholder="email@example.com" required>
                    @error('email')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Password <span style="color:#d4af37">*</span></label>
                    <input type="password" class="f-control" name="password"
                           placeholder="Min. 8 characters" required>
                    @error('password')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('user.index') }}" class="btn-outline-gold">Cancel</a>
                <button type="submit" class="btn-gold">
                    <i class="fa-solid fa-floppy-disk"></i> Save User
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

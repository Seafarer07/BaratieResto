@extends('admin.sidebar')
@section('title', 'Edit User')
@section('page-title', 'Edit <span>User</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Edit User</h2>
        <div class="breadcrumb-bar">
            <a href="{{ route('user.index') }}">Users</a> / Edit {{ $user->nama_pelanggan }}
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
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="f-label">Profile Photo</label>
                @if($user->gambar)
                    <img id="imgPreview" src="{{ asset($user->gambar) }}" alt="Current"
                         style="display:block;margin-bottom:10px;width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid rgba(212,175,55,.4);">
                @else
                    <img id="imgPreview" src="" alt=""
                         style="display:none;margin-bottom:10px;width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid rgba(212,175,55,.4);">
                @endif
                <input type="file" class="f-control" name="gambar" accept="image/*"
                       onchange="previewImg(event)">
                @error('gambar')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Full Name <span style="color:#d4af37">*</span></label>
                    <input type="text" class="f-control" name="nama_pelanggan"
                           value="{{ old('nama_pelanggan', $user->nama_pelanggan) }}" required>
                    @error('nama_pelanggan')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">Phone <span style="color:#d4af37">*</span></label>
                    <input type="tel" class="f-control" name="telepon"
                           value="{{ old('telepon', $user->telepon) }}" required>
                    @error('telepon')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="f-label">Email <span style="color:#d4af37">*</span></label>
                    <input type="email" class="f-control" name="email"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div class="col-md-6">
                    <label class="f-label">New Password</label>
                    <input type="password" class="f-control" name="password"
                           placeholder="Leave blank to keep current">
                    @error('password')<p style="color:#e07070;font-size:.78rem;margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end mt-4">
                <a href="{{ route('user.index') }}" class="btn-outline-gold">Cancel</a>
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

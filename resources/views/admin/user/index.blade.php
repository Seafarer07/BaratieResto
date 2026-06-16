@extends('admin.sidebar')
@section('title', 'Users')
@section('page-title', 'Manage <span>Users</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Users</h2>
        <div class="breadcrumb-bar">Admin / Users</div>
    </div>
    <a href="{{ route('user.create') }}" class="btn-gold">
        <i class="fa-solid fa-plus"></i> Add User
    </a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h5>All Users</h5>
        <span style="color:#666;font-size:.78rem;">{{ $user->total() }} users</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($user as $item)
                <tr>
                    <td>
                        @php
                            $av = $item->gambar && file_exists(public_path($item->gambar))
                                ? asset($item->gambar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($item->nama_pelanggan) . '&background=2a2a2a&color=d4af37&size=64';
                        @endphp
                        <img src="{{ $av }}" class="td-avatar" alt="avatar">
                    </td>
                    <td style="font-weight:600;color:#eaeaea;">{{ $item->nama_pelanggan }}</td>
                    <td style="color:#888;font-size:.85rem;">{{ $item->email }}</td>
                    <td style="color:#aaa;font-size:.85rem;">{{ $item->telepon }}</td>
                    <td>
                        @if($item->is_admin)
                            <span class="badge-gold">Admin</span>
                        @else
                            <span style="color:#555;font-size:.78rem;">Customer</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <a href="{{ route('user.edit', $item->id) }}" class="btn-outline-gold">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('user.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this user?')" style="margin:0">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#555;padding:32px;">No users yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($user->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $user->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

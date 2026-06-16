@extends('admin.sidebar')
@section('title', 'Menu')
@section('page-title', 'Manage <span>Menu</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Menu</h2>
        <div class="breadcrumb-bar">Admin / Menu</div>
    </div>
    <a href="{{ route('menu.create') }}" class="btn-gold">
        <i class="fa-solid fa-plus"></i> Add Menu Item
    </a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h5>All Menu Items</h5>
        <span style="color:#666;font-size:.78rem;">{{ $menu->total() }} items</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menu as $item)
                <tr>
                    <td><img src="{{ asset($item->image) }}" alt="{{ $item->nama_menu }}" class="td-img"></td>
                    <td style="font-weight:600;color:#eaeaea;">{{ $item->nama_menu }}</td>
                    <td><span class="badge-gold">{{ $item->kategori }}</span></td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <a href="{{ route('menu.edit', $item->id) }}" class="btn-outline-gold">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('menu.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this menu item?')" style="margin:0">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-danger-sm">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:#555;padding:32px;">No menu items yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($menu->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $menu->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

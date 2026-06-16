@extends('admin.sidebar')
@section('title', 'Meja')
@section('page-title', 'Manage <span>Tables</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Tables (Meja)</h2>
        <div class="breadcrumb-bar">Admin / Tables</div>
    </div>
    <a href="{{ route('meja.create') }}" class="btn-gold">
        <i class="fa-solid fa-plus"></i> Add Table
    </a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h5>All Tables</h5>
        <span style="color:#666;font-size:.78rem;">{{ $meja->total() }} tables</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="a-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Table Type</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($meja as $item)
                <tr>
                    <td style="color:#666;">{{ $item->id }}</td>
                    <td style="font-weight:600;color:#eaeaea;">{{ $item->jenis }}</td>
                    <td style="color:#aaa;">
                        @if($item->jenis === 'Reguler') 2 seats
                        @elseif($item->jenis === 'VIP') 4 seats
                        @else 8 seats
                        @endif
                    </td>
                    <td>
                        @if($item->status === 'Available')
                            <span class="badge-success">Available</span>
                        @else
                            <span class="badge-danger">Booked</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <a href="{{ route('meja.edit', $item->id) }}" class="btn-outline-gold">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('meja.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this table?')" style="margin:0">
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
                    <td colspan="5" style="text-align:center;color:#555;padding:32px;">No tables yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($meja->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $meja->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

@extends('admin.sidebar')
@section('title', 'Reservations')
@section('page-title', 'Manage <span>Reservations</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Reservations</h2>
        <div class="breadcrumb-bar">Admin / Reservations</div>
    </div>
    <a href="{{ route('reservasi.create') }}" class="btn-gold">
        <i class="fa-solid fa-plus"></i> Add Reservation
    </a>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h5>All Reservations</h5>
        <span style="color:#666;font-size:.78rem;">{{ $reservasi->total() }} records</span>
    </div>
    <div style="overflow-x:auto;">
        <table class="a-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Guest</th>
                    <th>Table</th>
                    <th>Date</th>
                    <th>Note</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservasi as $item)
                <tr>
                    <td style="color:#666;">{{ $item->id }}</td>
                    <td style="color:#eaeaea;">{{ optional($item->user)->nama_pelanggan ?? $item->id_user }}</td>
                    <td>
                        @if($item->meja)
                            <span class="badge-gold">{{ $item->meja->jenis }}</span>
                        @else
                            <span style="color:#555;">—</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_reservasi)->format('d M Y') }}</td>
                    <td style="color:#888;font-size:.82rem;max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        {{ $item->note ?: '—' }}
                    </td>
                    <td>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <a href="{{ route('reservasi.edit', $item->id) }}" class="btn-outline-gold">
                                <i class="fa-solid fa-pen"></i> Edit
                            </a>
                            <form action="{{ route('reservasi.destroy', $item->id) }}" method="POST"
                                  onsubmit="return confirm('Delete this reservation?')" style="margin:0">
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
                    <td colspan="6" style="text-align:center;color:#555;padding:32px;">No reservations yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reservasi->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $reservasi->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

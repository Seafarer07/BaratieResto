@extends('admin.sidebar')
@section('title', 'Dashboard')
@section('page-title', 'Admin <span>Dashboard</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Dashboard</h2>
        <div class="breadcrumb-bar">Overview of your restaurant</div>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value" id="cnt-users" data-target="{{ \App\Models\User::count() }}">0</div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Reservations</div>
                <div class="stat-value" id="cnt-reservasi" data-target="{{ \App\Models\Reservasi::count() }}">0</div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Menu Items</div>
                <div class="stat-value" id="cnt-menu" data-target="{{ \App\Models\Menu::count() }}">0</div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-utensils"></i></div>
        </div>
    </div>
    <div class="col-6 col-xl-3">
        <div class="stat-card">
            <div>
                <div class="stat-label">Reviews</div>
                <div class="stat-value" id="cnt-review" data-target="{{ \App\Models\Review::count() }}">0</div>
            </div>
            <div class="stat-icon"><i class="fa-solid fa-star"></i></div>
        </div>
    </div>
</div>

{{-- Tables Row --}}
<div class="row g-3">

    {{-- Recent Reservations --}}
    <div class="col-12 col-xl-7">
        <div class="a-card">
            <div class="a-card-header">
                <h5>Recent Reservations</h5>
                <a href="{{ route('reservasi.index') }}" class="btn-outline-gold" style="font-size:.7rem;padding:5px 12px;">View All</a>
            </div>
            <div style="overflow-x:auto;">
                <table class="a-table">
                    <thead>
                        <tr>
                            <th>Guest</th>
                            <th>Table Type</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $recent = \App\Models\Reservasi::with('user','meja')->latest()->limit(8)->get(); @endphp
                        @forelse($recent as $r)
                        <tr>
                            <td>{{ optional($r->user)->nama_pelanggan ?? '—' }}</td>
                            <td>{{ optional($r->meja)->jenis ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($r->tanggal_reservasi)->format('d M Y') }}</td>
                            <td>
                                @if(optional($r->meja)->status === 'Available')
                                    <span class="badge-success">Available</span>
                                @else
                                    <span class="badge-danger">Booked</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" style="text-align:center;color:#555;padding:24px;">No reservations yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Recent Users --}}
    <div class="col-12 col-xl-5">
        <div class="a-card">
            <div class="a-card-header">
                <h5>Recent Users</h5>
                <a href="{{ route('user.index') }}" class="btn-outline-gold" style="font-size:.7rem;padding:5px 12px;">View All</a>
            </div>
            <div style="overflow-x:auto;">
                <table class="a-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $recentUsers = \App\Models\User::latest()->limit(8)->get(); @endphp
                        @foreach($recentUsers as $u)
                        <tr>
                            <td>
                            @php
                                $av = $u->gambar && file_exists(public_path($u->gambar))
                                    ? asset($u->gambar)
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($u->nama_pelanggan) . '&background=2a2a2a&color=d4af37&size=64';
                            @endphp
                            <img src="{{ $av }}" class="td-avatar" alt="avatar">
                        </td>
                            <td>{{ $u->nama_pelanggan }}</td>
                            <td style="color:#666;font-size:.8rem;">{{ $u->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.stat-value[data-target]').forEach(el => {
        const target = +el.dataset.target;
        const step = Math.max(1, Math.ceil(target / 60));
        let cur = 0;
        const tick = () => {
            cur = Math.min(cur + step, target);
            el.textContent = cur;
            if (cur < target) requestAnimationFrame(tick);
        };
        tick();
    });
});
</script>

@endsection

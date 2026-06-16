@extends('admin.sidebar')
@section('title', 'Reviews')
@section('page-title', 'Manage <span>Reviews</span>')
@section('content')

<div class="page-heading">
    <div>
        <h2>Reviews</h2>
        <div class="breadcrumb-bar">Admin / Reviews</div>
    </div>
    <span style="color:#666;font-size:.82rem;">{{ $reviews->total() }} reviews total</span>
</div>

<div class="a-card">
    <div class="a-card-header">
        <h5>All Customer Reviews</h5>
    </div>
    <div style="overflow-x:auto;">
        <table class="a-table">
            <thead>
                <tr>
                    <th>Guest</th>
                    <th>Menu</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reviews as $review)
                <tr>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <img src="{{ asset(optional($review->user)->gambar ?? 'public/images/default.jpg') }}"
                                 class="td-avatar" alt="avatar">
                            <span style="color:#eaeaea;">{{ optional($review->user)->nama_pelanggan ?? '—' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($review->menu)
                            <span class="badge-gold">{{ $review->menu->nama_menu }}</span>
                        @else
                            <span style="color:#555;">—</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex;gap:2px;align-items:center;">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star" style="font-size:.75rem;color:{{ $i <= $review->rating ? '#d4af37' : '#333' }};"></i>
                            @endfor
                            <span style="color:#888;font-size:.78rem;margin-left:4px;">{{ $review->rating }}/5</span>
                        </div>
                    </td>
                    <td style="color:#aaa;font-size:.85rem;max-width:220px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                        {{ $review->note ?: '—' }}
                    </td>
                    <td style="color:#666;font-size:.8rem;white-space:nowrap;">
                        {{ $review->created_at->format('d M Y') }}
                    </td>
                    <td>
                        <form action="{{ route('review.destroy', $review->id) }}" method="POST"
                              onsubmit="return confirm('Delete this review?')" style="margin:0">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-danger-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;color:#555;padding:32px;">No reviews yet</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($reviews->hasPages())
    <div style="padding:16px 22px;border-top:1px solid var(--border);">
        {{ $reviews->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection

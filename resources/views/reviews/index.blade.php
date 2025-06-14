@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4 text-center">Đánh giá cho sản phẩm: <strong>{{ $product->name }}</strong></h3>
    <div class="card shadow-sm mb-3">
    <div class="card-body">
        <form method="GET" class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                       placeholder="Tìm trong đánh giá...">
            </div>
            <div class="col-md-3">
                <select name="rating" class="form-select">
                    <option value="">Tất cả số sao</option>
                    @for ($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} sao</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Lọc</button>
                <a href="{{ route('products.reviews', $product->id) }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>

        <p class="mb-3">
            <strong>Tổng số đánh giá:</strong> {{ $totalComments }} <br>
            <strong>Điểm trung bình:</strong> {{ number_format($averageRating, 1) }} / 5
        </p>

        {{-- Vòng lặp hiển thị bình luận ở đây --}}
        @forelse($comments as $comment)
            {{-- ... giữ nguyên đoạn hiển thị đánh giá ... --}}
        @empty
            <p class="text-muted">Không tìm thấy đánh giá phù hợp.</p>
        @endforelse
    </div>
</div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            @forelse ($comments as $comment)
                <div class="d-flex mb-3">
                    <img src="{{ $comment->user->avatar ? asset($comment->user->avatar) : 'https://via.placeholder.com/50' }}"
                         class="rounded-circle me-3" alt="avatar" width="50" height="50">

                    <div>
                        <h6 class="mb-1">
                            {{ $comment->user->name }}
                            <small class="text-muted">- {{ $comment->rating }} sao</small>
                        </h6>
                        <small class="text-muted">Đăng lúc {{ $comment->created_at->format('H:i d/m/Y') }}</small>

                        <div class="text-warning mb-1">
                            {!! str_repeat('★', $comment->rating) !!}{!! str_repeat('☆', 5 - $comment->rating) !!}
                        </div>

                        <p class="mb-1">{{ $comment->content }}</p>

                        @if($comment->images->count())
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach ($comment->images as $img)
                                    <img src="{{ asset($img->image_url) }}" class="img-thumbnail" width="100" height="75" alt="comment-img">
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
            @endforelse
        </div>
    </div>
    @if ($comments->hasPages())
<nav>
    <ul class="pagination justify-content-center">
        {{-- Nút Trước --}}
        <li class="page-item {{ $comments->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $comments->previousPageUrl() }}" tabindex="-1">Trước</a>
        </li>

        {{-- Các nút số --}}
        @foreach ($comments->links()->elements[0] as $page => $url)
            @if ($page == $comments->currentPage())
                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Nút Sau --}}
        <li class="page-item {{ $comments->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $comments->nextPageUrl() }}">Sau</a>
        </li>
    </ul>
</nav>
@endif
    <a href="{{ route('products.index') }}" class="btn btn-secondary">← Quay lại danh sách sản phẩm</a>
     <a href="{{ route('reviews.create', ['product_id' => $product->id]) }}" class="btn btn-success">
            + Thêm đánh giá
        </a>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-center">Danh sách sản phẩm</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Giá (VND)</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
            <tr>
                <td>{{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ Str::limit($product->description, 100) }}</td>
                <td class="text-end text-primary">{{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('products.reviews', $product->id) }}" class="btn btn-sm btn-outline-primary">
                        Xem đánh giá
                    </a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($products->hasPages())
    <nav>
        <ul class="pagination justify-content-center">
            {{-- Nút Trước --}}
            <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">Trước</a>
            </li>

            {{-- Các nút số --}}
            @foreach ($products->links()->elements[0] as $page => $url)
            @if ($page == $products->currentPage())
            <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
            @endif
            @endforeach

            {{-- Nút Sau --}}
            <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}">Sau</a>
            </li>
        </ul>
    </nav>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-center">Thêm đánh giá cho sản phẩm: <strong>{{ $product->name }}</strong></h3>

    <form action="{{ route('reviews.store', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nội dung đánh giá</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Số sao</label>
            <select name="rating" class="form-select" required>
                <option value="">Chọn sao</option>
                @for($i=5; $i>=1; $i--)
                    <option value="{{ $i }}">{{ $i }} sao</option>
                @endfor
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh đính kèm (có thể chọn nhiều)</label>
            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
            <div class="mt-2 d-flex flex-wrap gap-2" id="preview"></div>
        </div>

        <button type="submit" class="btn btn-success">Gửi đánh giá</button>
        <a href="{{ route('products.reviews', $product->id) }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
<script>
    document.getElementById('images').addEventListener('change', function(event) {
        const preview = document.getElementById('preview');
        preview.innerHTML = ''; // clear

        Array.from(event.target.files).forEach(file => {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.width = '100px';
                    img.style.height = '75px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection



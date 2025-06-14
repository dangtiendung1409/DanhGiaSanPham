@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Cập nhật thông tin cá nhân</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        {{-- Họ tên --}}
        <div class="mb-3">
            <label for="name" class="form-label">Họ tên</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="{{ old('name', $user->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
        </div>

        {{-- Avatar --}}
        <div class="mb-3">
            <label for="avatar" class="form-label">Ảnh đại diện</label><br>
            <img id="avatarPreview"
                 src="{{ $user->avatar ? asset($user->avatar) : 'https://via.placeholder.com/100' }}"
                 alt="Avatar Preview"
                 width="100" class="mb-2 rounded-circle" style="display: block;">
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            @error('avatar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const avatarInput = document.getElementById('avatar');
        const avatarPreview = document.getElementById('avatarPreview');

        if (avatarInput && avatarPreview) {
            avatarInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        avatarPreview.src = e.target.result;
                        avatarPreview.style.display = 'block';
                    };
                    reader.onerror = function (e) {
                        console.error('Error reading file:', e);
                    };
                    reader.readAsDataURL(file);
                } else {
                    console.warn('No file selected or invalid file type');
                }
            });
        } else {
            console.error('Avatar input or preview element not found');
        }
    });
</script>
@endsection


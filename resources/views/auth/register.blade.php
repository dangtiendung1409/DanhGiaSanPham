@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="min-width: 400px;">
        <h3 class="mb-4 text-center">Đăng ký</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}" placeholder="Nhập họ tên" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email') }}" placeholder="Nhập email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu:</label>
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Nhập mật khẩu" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Xác nhận mật khẩu:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                       placeholder="Nhập lại mật khẩu" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a></small>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-sm p-4" style="min-width: 400px;">
        <h3 class="mb-4 text-center">Đăng nhập</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
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
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a></small>
        </div>
    </div>
</div>
@endsection

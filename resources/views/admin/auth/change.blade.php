@extends('admin.layouts.auth')
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            @if (session('fails'))
            <div class="alert alert-danger">
                {{ session('fails') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-primary text-center">
                {{ session('success') }}
            </div>
        @endif
            <div id="auth-left">
                <div class="auth-logo mb-3">
                    <a href="index.html"><img src="{{ asset('public/logo.png') }}"
                            alt="Logo"></a>
                </div>
                <h1 class="auth-title" style="font-size: 40px;">Đổi mật khẩu</h1>
                @if (session('fails'))
                    <div class="alert alert-danger">
                        {{session('fails')}}
                    </div>
                @endif
                <form action="{{ url('admin/postChange') }}" id="change-form" method="POST">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="email" name="email" disabled class="form-control form-control-xl" value="{{$user->email}}" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('email')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" name="id" value="{{Auth::guard('admin')->id()}}">
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password" id="password" class="form-control form-control-xl"
                            placeholder="Mật khẩu">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-4">
                        <input type="password" name="password_confirmation" class="form-control form-control-xl"
                            placeholder="Xác nhận mật khẩu">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password_confirmation')
                            <div class="form-text text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đổi mật khẩu</button>
                </form>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>

</div>

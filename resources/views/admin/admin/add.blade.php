@extends('admin.layouts.app')
@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        @if (session('fails'))
            <div class="alert alert-danger">
                {{ session('fails') }}
            </div>
        @endif
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Thêm admin</h6>
                    <form method="POST" id="add-user-form" action="{{ url('admin/admin-create') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="inputname" class="col-sm-2 col-form-label">Họ và tên</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" value="" class="form-control" id="inputname">
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="" class="form-control" id="inputEmail3">
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputpass" class="col-sm-2 col-form-label">Mật khẩu</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" value="" class="form-control" id="inputpass">
                                @error('password')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">
                                <input type="text" name="phone" value="" class="form-control" id="inputphone">

                                @error('phone')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" name="address" value="" class="form-control" id="inputaddress">

                                @error('address')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Giới tính</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" checked type="radio" name="gender" id="gridRadios1"
                                        value="male">
                                    <label class="form-check-label" for="gridRadios1">
                                        Nam
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="gridRadios2"
                                        value="female">
                                    <label class="form-check-label" for="gridRadios2">
                                        Nữ
                                    </label>
                                </div>
                                @error('gender')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

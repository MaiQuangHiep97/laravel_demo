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
            <div class="col-12" id="order-cart-none">
                @if (count($items) > 0)
                    <div class="bg-light rounded h-100 p-4" id="order-cart-table">
                        <h6 class="mb-4">Thêm thông tin khách hàng</h6>
                        <form method="POST" id="edit-user-form" action="{{ url('admin/order-create') }}">
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
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Thanh toán</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" checked type="radio" name="payment" id="payment"
                                            value="COD">
                                        <label class="form-check-label" for="payment">
                                            COD
                                        </label>
                                    </div>
                                    @error('payment')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-4">Thông tin đơn hàng</h6>
                                <a href="{{ url('admin/order-add') }}" class="btn btn-primary">Thêm sản phẩm
                                </a>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Ảnh đại diện</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($items as $item)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr class="item-{{ $item->id }}">
                                                <th scope="row">{{ $i }}</th>
                                                <td><img src="{{ asset('storage/app/products/' . $item->options->image) }}"
                                                        style="width: 60px; height: 60px;" alt=""></td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    <div class="input-number cart-qty">
                                                        <input type="number" value="{{ $item->qty }}" min="0" max="20"
                                                            class="products-qty-{{ $item->id }} input-qty-order"
                                                            data-product-id="{{ $item->id }}"
                                                            data-id="{{ $item->rowId }}">
                                                    </div>
                                                </td>
                                                <td class="sub-total-{{ $item->id }}">@price( $item->price * $item->qty
                                                    )</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-cart"
                                                        data-product-id="{{ $item->id }}"
                                                        data-id="{{ $item->rowId }}">Xoá
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>Tổng giá:</th>
                                        <td id="total">{{ Cart::total() }} đ</td>
                                        <input type="hidden" name="total" value="{{ Cart::total() }}">
                                    </tfoot>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-primary">Xác nhận</button>
                        </form>
                    </div>
                @else
                    <div class='text-center' style='margin-top: 30px;'>
                        <h5>Không có sản phẩm trong giỏ hàng</h5>
                        <a href='{{ url('admin/order-add') }}'>Thêm đơn hàng</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

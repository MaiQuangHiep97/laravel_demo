@extends('admin.layouts.app')
@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        @if (session('fails'))
            <div class="alert alert-danger">
                {{ session('fails') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-primary">
                {{ session('success') }}
            </div>
        @endif
        <div class="row g-4">
            <div class="col-12" id="order-cart-none">
                @if (!empty($orders))
                    <div class="bg-light rounded h-100 p-4" id="order-cart-table">
                        <h6 class="mb-4">Thông tin khách hàng</h6>
                        <form method="POST" id="edit-order-form" action="{{ url('admin/order-update', $orders->id) }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $orders->user_id }}">
                            <div class="row mb-3">
                                <label for="inputname" class="col-sm-2 col-form-label">Họ và tên</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" disabled value="{{ $orders->user->name }}"
                                        class="form-control" id="inputname">
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" disabled value="{{ $orders->user->email }}"
                                        class="form-control" id="inputEmail3">
                                    @error('email')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputphone" class="col-sm-2 col-form-label">Số điện thoại</label>
                                <div class="col-sm-10">
                                    <input type="text" name="phone" value="{{ $orders->user->infomation->phone }}"
                                        class="form-control" id="inputphone">
                                    @error('phone')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputaddress" class="col-sm-2 col-form-label">Địa chỉ</label>
                                <div class="col-sm-10">
                                    <input type="text" name="address"
                                        value="{{ $orders->address != null ? $orders->address : $orders->user->infomation->address }}"
                                        class="form-control" id="inputaddress">
                                    @error('address')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputname" class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="col-sm-10">
                                    <select name="status" id="" class="form-control">
                                        @foreach ($orders->status_array as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ $key == $orders->status ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Giới tính</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            {{ $orders->user->infomation->gender == 'male' ? 'checked' : '' }}
                                            type="radio" name="gender" id="gridRadios1" value="male">
                                        <label class="form-check-label" for="gridRadios1">
                                            Nam
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            {{ $orders->user->infomation->gender == 'female' ? 'checked' : '' }}
                                            type="radio" name="gender" id="gridRadios2" value="female">
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
                                <a href="{{ url('admin/order-edit-add', $orders->id) }}" class="btn btn-primary">Thêm sản
                                    phẩm
                                </a>
                            </div>
                            <div class="table-responsive mt-3" id="notification">
                                <table class="table" id="table-order">
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
                                        @foreach ($order_products as $order_product)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr class="order-{{ $order_product->product->id }}">
                                                <th scope="row">{{ $i }}</th>
                                                <td><img src="{{ asset('storage/app/products/' . $order_product->product->product_thumb) }}"
                                                        style="width: 60px; height: 60px;" alt=""></td>
                                                <td>{{ $order_product->product->product_name }}</td>
                                                <td>
                                                    <div class="input-number cart-qty">
                                                        <input type="number" value="{{ $order_product->quantity }}"
                                                            min="0" max="20"
                                                            class="products-qty-{{ $order_product->id }} input-qty-edit"
                                                            data-product-id="{{ $order_product->product->id }}"
                                                            data-id="{{ $orders->id }}">
                                                    </div>
                                                    <input type="hidden"
                                                        class="products-price-{{ $order_product->product->id }}"
                                                        value="{{ $order_product->product->product_price }}">
                                                </td>
                                                <td class="sub-total-{{ $order_product->product->id }}">@price(
                                                    $order_product->product->product_price * $order_product->quantity)</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger remove-item-order"
                                                        data-id="{{ $orders->id }}"
                                                        data-product-id="{{ $order_product->product->id }}">Xoá
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <th>Tổng giá:</th>
                                        <td id="total">{{ $orders->total_price }} đ</td>
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

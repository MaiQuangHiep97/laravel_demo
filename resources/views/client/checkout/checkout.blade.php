@extends('client.layouts.app')
@section('content')
    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="">Home</a></li>
                    @foreach ($categories as $category)
                        <li><a href="{{ url('category', $category->id) }}">{{ $category->category_name }}</a></li>
                    @endforeach
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <form action="{{ url('post-checkout') }}" method="post" id="edit-order-form">
                @csrf
                <div class="row">

                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Thông tin khách hàng</h3>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                                <input class="input form-control" disabled type="text" name="name"
                                    value="{{ Auth::user()->name }}" placeholder="Name">
                                    @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input form-control" disabled type="email" name="email"
                                    value="{{ Auth::user()->email }}" placeholder="Email">
                                    @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input form-control" type="text" name="address"
                                    value="{{ $user->infomation->address??'' }}" placeholder="Address">
                                    @error('address')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input class="input form-control" type="text" name="phone"
                                    value="{{ $user->infomation->phone??'' }}" placeholder="Telephone">
                                    @error('phone')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Địa chỉ khác</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Giao đến địa chỉ khác?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input class="input form-control" type="text" name="address1" placeholder="Address">
                                    </div>
                                    @error('address1')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Thông tin đơn hàng</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>SẢN PHẨM</strong></div>
                                <div><strong>TỔNG GIÁ</strong></div>
                            </div>
                            <div class="order-products">
                                {{-- <input type="hidden" name="product_orders" value="{{$contents}}"> --}}
                                <input type="hidden" name="total" value="{{Cart::total()}}">
                                @foreach ($contents as $item)
                                {{-- <input type="hidden" name="product_id[]" value="{{$item->id}}">
                                <input type="hidden" name="product_qty[]" value="{{$item->qty}}"> --}}
                                    <div class="order-col">
                                        <div>{{ $item->qty }}x {{ $item->name }}</div>
                                        <div>@price($item->subtotal)</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">{{ Cart::total() }} đ</strong></div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" checked name="payment" value="COD" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    COD
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger form-control">ĐẶT HÀNG</button>
                    </div>
                    <!-- /Order Details -->
                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection

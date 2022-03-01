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
                        <li><a href="{{ url('category', $category->slug) }}">{{ $category->category_name }}</a></li>
                    @endforeach
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->


    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Danh sách sản phẩm</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                @foreach ($categories as $category)
                                    <li><a
                                            href="{{ url('category', $category->slug) }}">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="amount">Lọc theo giá:</label>
                            <div id="slider-range"></div>
                            <form action="" method="get">
                                    <label for="">Từ:</label>
                                    <input type="text" id="amount-start" readonly
                                        style="border:0; color:#f6931f; font-weight:bold;"><br>
                                    <label for="">Đến:</label>
                                    <input type="text" id="amount-end" readonly
                                        style="border:0; color:#f6931f; font-weight:bold;">
                                    <input type="hidden" name="start_price" value="" id="start-price">
                                    <input type="hidden" name="end_price" value="" id="end-price">
                                <input type="submit" class="btn btn-primary" value="Lọc">
                            </form>
                        </div>
                    </div>
                    <!-- Products tab & slick -->
                    <div class="col-md-12">
                        <div class="row">
                            <!-- product -->
                            @if (count($products) > 0)
                                @foreach ($products as $product)
                                    <div class="col-md-3">
                                        <div class="product">
                                            <form action="{{ url('cart-add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" class="products-name-{{ $product->id }}"
                                                    value="{{ $product->product_name }}">
                                                <input type="hidden" class="products-thumb-{{ $product->id }}"
                                                    value="{{ $product->product_thumb }}">
                                                <input type="hidden" class="products-price-{{ $product->id }}"
                                                    value="{{ $product->product_price }}">
                                                <input type="hidden" class="products-qty-{{ $product->id }}" value="1">
                                                <div class="product-img">
                                                    <img src="{{ asset('storage/app/products/' . $product->product_thumb) }}"
                                                        alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a
                                                            href="{{ url('/product-detail', $product->slug) }}">{{ $product->product_name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">@price($product->product_price)</h4>
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <div class="add-to-cart">
                                                    <button class="add-to-cart-btn" type="button"
                                                        data-id="{{ $product->id }}"><i class="fa fa-shopping-cart"></i>
                                                        add
                                                        to
                                                        cart</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center" style="margin-top: 30px;">
                                    <h4 class="">There are no items</h4>
                                    <a href="{{ url('/') }}">Home page</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Products tab & slick -->
                </div>
                <div class="d-flex justify-content-end">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /SECTION -->




        <!-- NEWSLETTER -->
    @endsection

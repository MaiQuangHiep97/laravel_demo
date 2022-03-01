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





    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        @foreach ($product->product_image as $image)
                            <div class="product-preview">
                                <img src="{{ asset('storage/app/products/' . $image->url_image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @foreach ($product->product_image as $image)
                            <div class="product-preview">
                                <img src="{{ asset('storage/app/products/' . $image->url_image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $product->product_name }}</h2>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Review(s) | Add your review</a>
                        </div>
                        <div>
                            <h3 class="product-price">@price($product->product_price)</h3>
                            <span class="product-available">In Stock</span>
                        </div>
                        <p>{{ $product->product_desc }}</p>
                        <div class="add-to-cart">
                            <form action="{{ url('cart-add') }}" method="post">
                                @csrf
                                <input type="hidden" class="products-name-{{ $product->id }}"
                                    value="{{ $product->product_name }}">
                                <input type="hidden" class="products-thumb-{{ $product->id }}"
                                    value="{{ $product->product_thumb }}">
                                <input type="hidden" class="products-price-{{ $product->id }}"
                                    value="{{ $product->product_price }}">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number input-number-detail">
                                        <input type="number" name="product_qty" value="1" id="input-qty"
                                            class="input-qty products-qty-{{ $product->id }}">
                                        <span class="qty-up">+</span>
                                        <span class="qty-down">-</span>
                                    </div>
                                </div>
                                <button class="add-to-cart-btn" type="button" data-id="{{ $product->id }}"><i
                                        class="fa fa-shopping-cart"></i>add to cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
                            <li><a data-toggle="tab" href="#tab2">Details</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{ $product->product_desc }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{!! $product->product_detail !!}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Products</h3>
                    </div>
                </div>

                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="product">
                            <div class="product-img">
                                <img src="{{ asset('storage/app/products/' . $product->product_thumb) }}" alt="">
                            </div>
                            <div class="product-body">
                                <h3 class="product-name"><a href="{{url('/product-detail', $product->slug)}}">{{ $product->product_name }}</a></h3>
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
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach


                <div class="clearfix visible-sm visible-xs"></div>



            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Electro - HTML Ecommerce Template</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/clients/css/bootstrap.min.css') }}" />
    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/clients/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/clients/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/clients/css/nouislider.min.css') }}" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('public/assets/clients/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/sweetalert.css') }}" />
    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/clients/css/style.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">


</head>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    @if (Auth::check())
                        <li><a href="{{ url('infor', Auth::id()) }}"><i class="fa fa-user-o"></i> Hello,
                                {{ Auth::user()->name }}</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit"><i class="fa fa-dollar"></i> Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}"><i class="fa fa-user-o"></i> Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ asset('public/assets/clients/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form method="GET" action="{{ url('/') }}">
                                <input type="text" name="search" class="input" value=""
                                    style="width: 75%; border-radius: 20px; float:left" placeholder="Search here">
                                <button type="submit" class="search-btn"
                                    style="border-radius: 20px; float:right">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">

                            <!-- Cart -->
                            <div class="dropdown">
                                <a href="{{ url('cart-show') }}" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty" id="qty">{{ Cart::count() }}</div>
                                </a>

                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->
    @yield('content')

    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Sign Up for the <strong>NEWSLETTER</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Enter Your Email">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->
    <!-- jQuery Plugins -->
    <script src="{{ asset('public/assets/clients/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/assets/clients/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/clients/js/slick.min.js') }}"></script>
    <script src="{{ asset('public/assets/clients/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('public/assets/clients/js/jquery.zoom.min.js') }}"></script>
    {{-- validate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset('public/validate.js')}}"></script>
    {{-- validate --}}
    <script src="{{ asset('public/assets/clients/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('public/assets/js/sweetalert.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('public/assets/clients/js/simple.money.format.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#slider-range").slider({
                range: true,
                min: {{ $min_price }},
                max: {{ $max_price_range }},
                values: [{{ $min_price }}, {{ $max_price_range }}],
                slide: function(event, ui) {
                    $("#amount-start").val(ui.values[0]).simpleMoneyFormat();
                    $("#amount-end").val(ui.values[1]).simpleMoneyFormat();
                    $("#start-price").val(ui.values[0]);
                    $("#end-price").val(ui.values[1]);
                }
            });
            $("#amount-start").val($("#slider-range").slider("values", 0)).simpleMoneyFormat();
            $("#amount-end").val($("#slider-range").slider("values", 1)).simpleMoneyFormat();
        });

        $('.input-number-detail').each(function() {
            var $this = $(this),
                $input = $this.find('input[type="number"]'),
                up = $this.find('.qty-up'),
                down = $this.find('.qty-down');

            down.on('click', function() {
                var value = parseInt($input.val()) - 1;
                value = value < 1 ? 1 : value;
                $input.val(value);
                $input.change();
            })

            up.on('click', function() {
                var value = parseInt($input.val()) + 1;
                $input.val(value);
                $input.change();
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.cart-qty').each(function() {
                var $this = $(this),
                    $input = $this.find('.cart-qty'),
                    cart_up = $this.find('.up'),
                    cart_down = $this.find('.down');

                cart_down.on('click', function() {
                    var value = parseInt($input.val()) - 1;
                    value = value < 1 ? 0 : value;
                    $input.val(value);
                    $input.change();
                })

                cart_up.on('click', function() {
                    var value = parseInt($input.val()) + 1;
                    $input.val(value);
                    $input.change();
                })
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.input-qty-detail').change(function() {
                var numOrder = $(this).val();
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                $.ajax({
                    url: '{{ url('cart-update') }}',
                    method: 'GET',
                    data: {
                        numOrder: numOrder,
                        id: id,
                        product_id: product_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.qty').text(data.count);
                        $('.sub-total-' + data.id).text(data.sub_total);
                        if (data.num_order == 0) {
                            $('.item-' + data.id).remove();
                        }
                        $('#total').text(data.total + 'đ');
                        if (data.count == 0) {
                            $('#cart-table').remove();
                            $('#cart-none').append(data.display);
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.remove-cart').click(function() {
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                $.ajax({
                    url: '{{ url('cart-delete') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        product_id: product_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.qty').text(data.count);
                        if (data.count == 0) {
                            $('#cart-table').remove();
                            $('#cart-none').append(data.display);
                        } else {
                            $('.item-' + data.id).remove();
                            $('#total').text(data.total + 'đ');
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.cart-destroy').click(function() {
                $.ajax({
                    url: '{{ url('cart-destroy') }}',
                    method: 'GET',
                    data: {},
                    dataType: 'json',
                    success: function(data) {
                        $('.qty').text(data.count);
                        $('#cart-table').remove();
                        $('#cart-none').append(data.display);
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function() {
                var id = $(this).attr('data-id');
                var name = $('.products-name-' + id).val();
                var thumb = $('.products-thumb-' + id).val();
                var price = $('.products-price-' + id).val();
                var qty = $('.products-qty-' + id).val();
                var _token = $("input[name='_token']").val();
                var data = {
                    id: id,
                    name: name,
                    thumb: thumb,
                    price: price,
                    qty: qty,
                    _token: _token
                };
                $.ajax({
                    url: '{{ url('cart-add') }}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function() {
                        swal({
                                title: "Đã thêm sản phẩm vào giỏ hàng",
                                text: "Bạn có thể mua hàng tiếp tục hoặc đến giỏ hàng để thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                CloseOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{ url('cart-show') }}";
                            });
                    }
                });
            })
        });
    </script>
</body>

</html>

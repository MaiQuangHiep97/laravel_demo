<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('public/theme/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/lib/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}"
        rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('public/theme/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('public/assets/css/sweetalert.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>

<body>
    <style>
        .error{
          color: red;
          font-style: italic;
      }
    </style>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{ asset('public/theme/img/user.jpg') }}" alt=""
                            style="width: 40px; height: 40px;">
                        <div
                            class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                        </div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::guard('admin')->user()->name }}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{ url('/admin') }}" class="nav-item nav-link"><i
                            class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    <a href="{{ url('/admin/list-admin') }}" class="nav-item nav-link"><i
                            class="fa fa-th me-2"></i>Danh sách Admin</a>
                    <a href="{{ url('/admin/list-user') }}" class="nav-item nav-link"><i
                            class="fa fa-keyboard me-2"></i>Danh sách User</a>
                    <a href="{{ url('/admin/cate-list') }}" class="nav-item nav-link"><i
                            class="fa fa-table me-2"></i>Danh mục</a>
                    <a href="{{ url('/admin/list-product') }}" class="nav-item nav-link"><i
                            class="fa fa-laptop me-2"></i>Sản phẩm</a>
                    <a href="{{ url('/admin/list-order') }}" class="nav-item nav-link"><i
                            class="fa fa-chart-bar me-2"></i>Đơn hàng</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{ asset('public/theme/img/user.jpg') }}" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::guard('admin')->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="{{ url('/admin/change') }}" class="dropdown-item">Đổi mật khẩu</a>
                            <a href="{{ url('/admin/logout') }}" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
            @yield('content')
            <!-- Footer Start -->
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- validate --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
  	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{-- validate --}}
    <script src="{{ asset('public/theme/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/theme/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/theme/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('public/theme/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('public/assets/clients/js/simple.money.format.js') }}"></script>
    <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
    <script src="{{ asset('public/validate.js') }}"></script>
    <script>
        CKEDITOR.replace('product-detail');
    </script>
    <!-- Template Javascript -->
    <script src="{{ asset('public/theme/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/sweetalert.js') }}"></script>

    {{-- Tạo slug tự động --}}

    <script type="text/javascript">

        function ChangeToSlug()
            {
                var slug;

                //Lấy text từ thẻ input title
                slug = document.getElementById("slug").value;
                slug = slug.toLowerCase();
                //Đổi ký tự có dấu thành không dấu
                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                    slug = slug.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slug = slug.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');
                    //Xóa các ký tự gạch ngang ở đầu và cuối
                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                    //In slug ra textbox có id “slug”
                document.getElementById('convert_slug').value = slug;
            }




    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.edit-cate').click(function() {
                $('#add').addClass('d-none');
                $('#edit').removeClass('d-none');
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '{{ url('admin/cate-edit/1') }}',
                    method: 'GET',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#input-cate').val(data.category_name);
                        $('#id-cate').val(data.id);
                    }
                });
            });
        });
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
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.remove-cart').click(function() {
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                $.ajax({
                    url: '{{ url('admin/order-cart-delete') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        product_id: product_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.count == 0) {
                            $('#order-cart-table').remove();
                            $('#order-cart-none').append(data.display);
                        } else {
                            $('.item-' + data.id).remove();
                            $('#total').text(data.total + 'đ');
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.input-qty-order').change(function() {
                var numOrder = $(this).val();
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                $.ajax({
                    url: '{{ url('admin/order-cart-update') }}',
                    method: 'GET',
                    data: {
                        numOrder: numOrder,
                        id: id,
                        product_id: product_id,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('.sub-total-' + data.id).text(data.sub_total);
                        if (data.num_order == 0) {
                            $('.item-' + data.id).remove();
                        }
                        $('#total').text(data.total + 'đ');
                        if (data.count == 0) {
                            $('#order-cart-table').remove();
                            $('#order-cart-none').append(data.display);
                        }
                    }
                });
            });
        });
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
                console.log(data);
                $.ajax({
                    url: '{{ url('admin/order-cart-add') }}',
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
                                window.location.href =
                                    "{{ url('admin/order-cart-show') }}";
                            });
                    }
                });
            })
        });

        $(document).ready(function() {
            $('.edit-add').click(function() {
                var id = $(this).attr('data-id');
                var id_order = $(this).attr('data-id-order');
                var price = $('.products-price-' + id).val();
                var qty = 1;
                var _token = $("input[name='_token']").val();
                var data = {
                    id: id,
                    id_order: id_order,
                    price: price,
                    qty: qty,
                    _token: _token
                };
                $.ajax({
                    url: '{{ url('admin/order-edit-store') }}',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function() {
                        swal({
                                title: "Đã thêm sản phẩm vào đơn hàng",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "OKE",
                                CloseOnConfirm: false
                            },
                            function() {
                                return true;
                            });
                    }
                });
            })
        });

        $(document).ready(function() {
            $('.input-qty-edit').change(function() {
                var numOrder = $(this).val();
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                var price = $('.products-price-' + product_id).val();
                $.ajax({
                    url: '{{ url('admin/order-edit-update') }}',
                    method: 'GET',
                    data: {
                        numOrder: numOrder,
                        id: id,
                        product_id: product_id,
                        price: price
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.qty == 0) {
                            $('.order-' + data.id).remove();
                        } else {
                            $('.sub-total-' + data.id).text(data.sub_total);
                        }
                        $('#total').text(data.total + 'đ');
                        if (data.count == 0) {
                            $('#table-order').remove();
                            $('#notification').append(data.display);
                        }
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.remove-item-order').click(function() {
                var id = $(this).attr('data-id');
                var product_id = $(this).attr('data-product-id');
                $.ajax({
                    url: '{{ url('admin/order-edit-delete') }}',
                    method: 'GET',
                    data: {
                        id: id,
                        product_id: product_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.count == 0) {
                            $('#table-order').remove();
                            $('#notification').append(data.display);
                        } else {
                            $('.order-' + data.id).remove();
                            $('#total').text(data.total + 'đ');
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>

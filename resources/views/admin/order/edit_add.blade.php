@extends('admin.layouts.app')
@section('content')
    <!-- Table Start -->
    <div class="container-fluid pt-4 px-4">
        {{-- {!! $admins->links() !!} --}}
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
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between">
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/order-edit-add', $order_id) }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <a href="{{ url('admin/order-edit', $order_id) }}" class="btn btn-primary mb-4">Quay lại</a>
                    </div>
                    <h6 class="mb-4">Danh sách sản phẩm</h6>
                    @if (count($products) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh đại diện</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($products as $product)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td><img src="{{ asset('storage/app/products/' . $product->product_thumb) }}"
                                                style="width: 60px; height: 60px;" alt=""></td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>@price( $product->product_price )</td>
                                        <form action="{{ url('admin/order-edit-add') }}" method="POST">
                                            @csrf
                                            <td class="">
                                                <input type="hidden" class="products-price-{{ $product->id }}"
                                                    value="{{ $product->product_price }}">
                                                {{-- <input type="hidden" class="products-qty-{{ $product->id }}" value="1"> --}}
                                                <div class="add-to-cart">
                                                    <button class="btn btn-primary edit-add" type="button"
                                                        data-id="{{ $product->id }}" data-id-order="{{$order_id}}"><i class="fa fa-shopping-cart"></i>
                                                        add to
                                                        cart</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{$products->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                    @else
                        <p class="text-center">Không có sản phẩm</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

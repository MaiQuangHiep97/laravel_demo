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
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/list-product') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <a href="{{ url('admin/product-add') }}" class="form-control border-0 btn mb-4 w-25">Thêm sản
                            phẩm</a>
                    </div>
                    <div class="col-12">
                        <div class="row  d-flex justify-content-between">
                            <div class="col-3">
                                <form action="" method="get">
                                    <div id="slider-range"></div>
                                    <label for="">Từ:</label>
                                    <input type="text" id="amount-start" readonly
                                        style="border:0; color:#f6931f; font-weight:bold;"><br>
                                    <label for="">Đến:</label>
                                    <input type="text" id="amount-end" readonly
                                        style="border:0; color:#f6931f; font-weight:bold;">
                                    <input type="hidden" name="start_price" value="" id="start-price">
                                    <input type="hidden" name="end_price" value="" id="end-price"> <br>
                                    <input type="submit" class="btn btn-primary d-flex justify-content-end" value="Lọc">
                                </form>
                            </div>
                            <div class="col-3">
                                <form class="d-none d-md-flex mb-4" action="{{ url('admin/list-product') }}">
                                    <select name="sort" id="" class="form-control">
                                        <option value="">--Sắp xếp theo</option>
                                        <option value="asc">Giá từ thấp đến cao</option>
                                        <option value="desc">Giá từ cao xuống thấp</option>
                                    </select>
                                    <button style="width: 50px; height: 40px;" class="border rounded"><i
                                            class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h6 class="mb-4 mt-4">Danh sách sản phẩm</h6>
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
                                        <td class="">
                                            <a href="{{ url('admin/product-delete', $product->id) }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                            <a href="{{ url('admin/product-edit', $product->slug) }}"><i
                                                    class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{ $products->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

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
                    <h6 class="mb-4">Chỉnh sửa sản phẩm</h6>
                    <form method="POST" id="editProduct" action="{{ url('admin/product-update', $products->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <input type="hidden" name="slug_old" value="{{$products->slug}}">
                            <label for="inputname" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_name" id="slug" onkeyup="ChangeToSlug();" value="{{$products->product_name}}" class="form-control">
                                @error('product_name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Slug</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_slug" id="convert_slug" value="{{$products->slug}}" class="form-control">
                                @error('product_slug')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Mô tả ngắn</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_desc" value="{{$products->product_desc}}" class="form-control">
                                @error('product_desc')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputname" class="col-sm-2 col-form-label">Giá sản phẩm</label>
                            <div class="col-sm-10">
                                <input type="text" name="product_price" value="{{$products->product_price}}" class="form-control">
                                @error('product_price')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputname" class="col-sm-2 col-form-label">Chi tiết sản phẩm</label>
                            <div class="col-sm-10">
                                <textarea name="product_detail" class="form-control" id="product-detail" cols="30" rows="10">{{$products->product_detail}}</textarea>
                                @error('phone')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Danh mục</label>
                            <div class="col-sm-10">
                                <select class="form-select mb-3" name="product_cate" aria-label="Default select example">
                                    <option>--Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                    <option {{($products->cate_id == $category->id) ? 'selected' : ''}} value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                @error('product_cate')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Ảnh đại diện</label>
                            <div class="col-sm-10">
                                <div class="mb-3">
                                    <input class="form-control" name="product_thumb" type="file" id="formFile">
                                </div>
                                <img class="" style="width:100px; height:100px;" src="{{ asset('storage/app/products/' . $products->product_thumb) }}" alt="">
                                @error('product_thumb')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="" class="col-sm-2 col-form-label">Ảnh đại diện</label>
                            <div class="col-sm-10">
                                <div class="mb-3">
                                    <input class="form-control" name="product_images[]" type="file" multiple>
                                </div>
                                @foreach ($products->product_image as $product)
                                <img class="" style="width:100px; height:100px; margin-right: 16px;" src="{{ asset('storage/app/products/' . $product->url_image) }}" alt="">
                                @endforeach
                                @error('product_images')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

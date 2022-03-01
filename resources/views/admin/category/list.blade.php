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
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/cate-list') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-xl-6" id="add">
                            <h6 class="mb-4">Thêm danh mục</h6>
                            <form method="POST" id="add-cat-form" action="{{ url('admin/cate-create') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="slug" class="form-label">Tên danh mục</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" onkeyup="ChangeToSlug();" class="form-control" id="slug">
                                    </div>
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <label for="convert_slug" class="form-label">Slug</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="cate_slug" class="form-control" id="convert_slug">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                            </form>
                        </div>
                        <div class="col-sm-12 col-xl-6 d-none" id="edit">
                            <h6 class="mb-4">Chỉnh sửa danh mục</h6>
                            <form method="POST" id="edit-cat-form" action="{{ url('admin/cate-update') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="" class="form-label">Tên danh mục</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="" class="form-control">
                                        <input type="hidden" name="id" value="" id="id-cate">
                                    </div>
                                    @error('name')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Chỉnh sửa danh mục</button>
                            </form>
                        </div>
                        <div class="col-sm-12 col-xl-6">
                            <h6 class="mb-4">Danh sách danh mục</h6>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên danh mục</th>
                                            <th scope="col" class="text-center">Tác vụ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($cates as $cate)
                                            @php
                                                $i++;
                                            @endphp
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $cate->category_name }}</td>
                                                <td class="d-flex justify-content-around">
                                                    <a href="{{ url('admin/cate-delete', $cate->id) }}"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    <a href="#" data-id={{ $cate->id }} class="edit-cate"><i
                                                            class="far fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    {{$cates->links('vendor.pagination.bootstrap-4')}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

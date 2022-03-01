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
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/list-admin') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <a href="{{url('admin/admin-add')}}" class="form-control border-0 btn mb-4 w-25">Thêm admin</a>
                    </div>
                    <h6 class="mb-4">Danh sách Admin</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Quyền</th>
                                    <th scope="col" class="text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($admins as $admin)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>admin</td>
                                        <td class="d-flex justify-content-around">
                                            @if (Auth::guard('admin')->id() !== $admin->id)
                                                <a href="{{ url('admin/admin-delete', $admin->id) }}"><i
                                                        class="far fa-trash-alt"></i></a>
                                            @endif
                                            <a href="{{ url('admin/admin-edit', $admin->id) }}"><i
                                                    class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{$admins->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

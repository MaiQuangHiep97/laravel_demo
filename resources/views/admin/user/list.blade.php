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
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/list-user') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <a href="{{url('admin/user-add')}}" class="form-control border-0 btn mb-4 w-25">Thêm user</a>
                    </div>
                    <h6 class="mb-4">Danh sách User</h6>
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
                                @foreach ($users as $user)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>user</td>
                                        <td class="d-flex justify-content-around">
                                            <a href="{{ url('admin/user-delete', $user->id) }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                            <a href="{{ url('admin/user-edit', $user->id) }}"><i
                                                    class="far fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {{$users->links('vendor.pagination.bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

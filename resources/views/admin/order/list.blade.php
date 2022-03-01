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
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/list-order') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin/list-order') }}">
                            <select name="status" id="" class="form-control">
                                <option value="">--Chọn trạng thái</option>
                                <option value="cancel">Huỷ</option>
                                <option value="handle">Đang xử lý</option>
                                <option value="transport">Đang vận chuyển</option>
                                <option value="done">Đã hoàn thành</option>
                            </select>
                            <button style="width: 50px; height: 40px;" class="border rounded"><i
                                    class="fas fa-search"></i></button>
                        </form>
                        <a href="{{ url('admin/order-add') }}" class="form-control border-0 btn mb-4 w-25">Thêm đơn
                            hàng</a>
                    </div>
                    @if (count($orders) > 0)
                        <h6 class="mb-4">Danh sách đơn hàng</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Mã đơn hàng</th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tổng giá</th>
                                        <th scope="col" class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 0;
                                    @endphp
                                    @foreach ($orders as $order)
                                        @php
                                            $i++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $order->code }}</th>
                                            <td>{{ $order->name }}</td>
                                            <td>
                                                @if ($order->status == 'cancel')
                                                    Huỷ
                                                @elseif ($order->status == 'handle')
                                                    Đang xử lý
                                                @elseif ($order->status == 'transport')
                                                    Đang vận chuyển
                                                @elseif ($order->status == 'done')
                                                    Hoàn thành
                                                @endif
                                            </td>
                                            <td>{{ $order->total_price }} đ</td>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ url('admin/order-edit', $order->id) }}"><i
                                                        class="far fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {{ $orders->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    @else
                        <p class="text-center">Không có đơn hàng</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Table End -->
@endsection

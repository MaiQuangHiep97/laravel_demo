@extends('admin.layouts.app')
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Hoàn thành</p>
                        <h6 class="mb-0">{{$count['done']}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đang vận chuyển</p>
                        <h6 class="mb-0">{{ $count['transport'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Đang xử lý</p>
                        <h6 class="mb-0">{{ $count['handle'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Huỷ</p>
                        <h6 class="mb-0">{{ $count['cancel'] }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between">
                        <form class="d-none d-md-flex mb-4 w-25" action="{{ url('admin') }}">
                            <input class="form-control border-0" name="key" value="" type="search" placeholder="Search">
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
                                            <td>{{ $order->user->name }}</td>
                                            <td>@if ($order->status == 'cancel')
                                                Huỷ
                                            @elseif ($order->status == 'handle')
                                                Đang xử lý
                                            @elseif ($order->status == 'transport')
                                                Đang vận chuyển
                                            @elseif ($order->status == 'done')
                                                Hoàn thành
                                            @endif</td>
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
                                {{ $orders->links('vendor.pagination.bootstrap-4') }}
                            </div>
                        </div>
                    @else
                        <p class="text-center">Không có đơn hàng</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection

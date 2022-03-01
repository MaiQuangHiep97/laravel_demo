@extends('client.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-10 col-md-offset-1" id="cart-none">
                @if (count($contents) > 0)
                    <table id="cart-table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>   </th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Sub Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contents as $item)
                                <!-- <input type="checkbox" class="form-check-input"> -->
                                <tr class="item-{{ $item->id }}">
                                    <td>
                                        <input type="checkbox" name="info_item" id="">
                                    </td>
                                    <td class="col-sm-8 col-md-6">
                                        <div class="media">
                                            <a class="thumbnail pull-left" href="#"> <img class="media-object"
                                                    src="{{ asset('storage/app/products/' . $item->options->image) }}"
                                                    style="width: 72px; height: 72px;"> </a>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href="#">{{ $item->name }}</a></h4>
                                                <span>Status: </span><span class="text-success"><strong>In
                                                        Stock</strong></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1" style="text-align: center">
                                        <div class="input-number cart-qty">
                                            <input type="number" name="product_qty" data-product-id="{{$item->id}}" data-id="{{ $item->rowId }}"
                                                value="{{ $item->qty }}" min="1" max="20" class="input-qty cart-qty input-qty-detail">
                                            <span class="qty-up up">+</span>
                                            <span class="qty-down down">-</span>
                                        </div>
                                    </td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong>@price($item->price)</strong></td>
                                    <td class="col-sm-1 col-md-1 text-center"><strong
                                            class="sub-total-{{$item->id}}">@price($item->subtotal)</strong>
                                    </td>
                                    <td class="col-sm-1 col-md-1">
                                        <button type="button" class="btn btn-danger remove-cart" data-product-id="{{$item->id}}"
                                        data-id="{{ $item->rowId }}">Remove
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td>
                                    <h3>Total</h3>
                                </td>
                                <td class="text-right">
                                    <h3><strong id="total">{{ Cart::total() . 'đ' }}</strong></h3>
                                </td>
                            </tr>
                            <tr>
                                <td>   </td>
                                <td>   </td>
                                <td>   </td>
                                <td><a href="#" class="btn btn-danger cart-destroy">Delete</a></td>
                                <td>
                                    <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
                                </td>
                                <td>
                                    <a href="{{ url('checkout') }}" class="btn btn-success">Checkout</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="text-center" style="margin-top: 30px;">
                        <h4>There are no items in the cart </h4>
                        <a href="{{ url('/') }}">Home page</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection



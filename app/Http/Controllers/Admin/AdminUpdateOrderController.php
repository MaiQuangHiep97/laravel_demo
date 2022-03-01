<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderProduct\OrderProductRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUpdateOrderController extends Controller
{
    protected $productRepo;
    protected $productImageRepo;
    protected $orderProductRepo;
    protected $orderRepo;
    protected $userRepo;
    protected $infomationRepo;
    public function __construct(
        ProductRepositoryInterface $productRepo,
        OrderProductRepositoryInterface $orderProductRepo,
        ProductImageRepositoryInterface $productImageRepo,
        OrderRepositoryInterface $orderRepo,
        UserRepositoryInterface $userRepo,
        InfomationRepositoryInterface $infomationRepo
    ) {
        $this->productRepo = $productRepo;
        $this->productImageRepo = $productImageRepo;
        $this->orderProductRepo = $orderProductRepo;
        $this->orderRepo = $orderRepo;
        $this->userRepo = $userRepo;
        $this->infomationRepo = $infomationRepo;
    }
    public function edit($id)
    {
        $orders = $this->orderRepo->get()->where('id', $id)->with('user.infomation')->first();
        $orders['status_array'] = $this->handleStatus($orders->status);
        $order_products = $this->orderProductRepo->get()->where('order_id', $id)->with('product')->get();;
        return view('admin.order.edit', compact('orders', 'order_products'));
    }
    public function edit_add(Request $request)
    {
        if ($request->key) {
            $key = $request->key;
            $products = $this->search_product($key, 10);
        } else {
            $products = $this->productRepo->get()->paginate(10)->withQueryString();
        }
        $order_id = $request->id;
        return view('admin.order.edit_add', compact('products', 'order_id'));
    }
    public function search_product($key, $count)
    {
        return DB::table('products')
            ->where('product_name', 'LIKE', "%{$key}%")
            ->orWhere('product_price', $key)
            ->paginate($count);
    }
    public function edit_store(Request $request)
    {
        $order_product = $this->orderProductRepo->get()->where('order_id', $request->id_order)->where('product_id', $request->id);
        if ($order_product->exists()) {
            $order_product->update(['quantity' => $request->qty]);
        } else {
            $this->orderProductRepo->get()->create(
                [
                    'quantity' => $request->qty,
                    'order_id' => $request->id_order,
                    'product_id' => $request->id
                ]
            );
        }
        $products = $this->orderProductRepo->get()->where('order_id', $request->id_order)->with('product')->get();
        $total = 0;
        foreach ($products as $product) {
            $total += $product->product->product_price * $product->quantity;
        }
        $this->orderRepo->update($request->id_order, ['total_price' => number_format($total)]);
        return true;
    }
    public function edit_update(Request $request)
    {
        $order_product = $this->orderProductRepo->get()->where('order_id', $request->id)->where('product_id', $request->product_id);
        if ($request->numOrder == 0) {
            $order_product->delete();
            $sub_total = 0;
        } else {
            $order_product->update(['quantity' => $request->numOrder]);
            $sub_total = $request->numOrder * $request->price;
        }
        return $this->update_ajax($request->id, $request->product_id, $request->numOrder, $sub_total);
    }
    public function edit_delete(Request $request)
    {
        $order_product = $this->orderProductRepo->get()->where('order_id', $request->id)->where('product_id', $request->product_id);
        $order_product->delete();
        $products = $this->orderProductRepo->get()->where('order_id', $request->id)->with('product')->get();
        if (count($products) >= 1) {
            $total = 0;
            foreach ($products as $product) {
                $total += $product->product->product_price * $product->quantity;
            }
            $this->orderRepo->update($request->id, ['total_price' => number_format($total)]);
            $data = [
                'id' => $request->product_id,
                'total' => number_format($total),
            ];
        } else {
            $this->orderRepo->update($request->id, ['total_price' => 0]);
            $data = [
                'count' => 0,
                'display' => "<div class='text-center' style='margin-top: 30px;'>
                <h4>Không có sản phẩm trong đơn hàng </h4>
            </div>"
            ];
        }
        return $data;
    }
    public function update_ajax($id, $product_id, $numOrder, $sub_total)
    {
        $products = $this->orderProductRepo->get()->where('order_id', $id)->with('product')->get();
        if (count($products) >= 1) {
            $total = 0;
            foreach ($products as $product) {
                $total += $product->product->product_price * $product->quantity;
            }
            $this->orderRepo->update($id, ['total_price' => number_format($total)]);
            $data = [
                'id' => $product_id,
                'qty' => $numOrder,
                'total' => number_format($total),
                'sub_total' => number_format($sub_total) . ' đ'
            ];
        } else {
            $this->orderRepo->update($id, ['total_price' => 0]);
            $data = [
                'qty' => $numOrder,
                'count' => 0,
                'display' => "<div class='text-center' style='margin-top: 30px;'>
                <h4>Không có sản phẩm trong đơn hàng </h4>
            </div>"
            ];
        }
        return $data;
    }
    public function update(Request $request, $id)
    {
        $this->orderRepo->update($id, [
            'status' => $request->status,
            'payment' => $request->payment
        ]);
        $order = $this->orderRepo->get()->where('id', $id);
        if($order->first()->address != null){
            $order->update([
                'address' => $request->address
            ]);
        }else{
            $this->infomationRepo->get()->where('infomationable_id', $request->user_id)
            ->where('infomationable_type', 'App\Models\User')
            ->update([
                'address' => $request->address,
            ]);
        }
        $this->infomationRepo->get()->where('infomationable_id', $request->user_id)
            ->where('infomationable_type', 'App\Models\User')
            ->update([
                'phone' => $request->phone,
                'gender' => $request->gender
            ]);
        return redirect()->back()->with('success', 'Chỉnh sửa đơn hàng thành công');
    }
    public function handleStatus($statusNow)
    {
        $status = [];
        if ($statusNow == 'cancel') {
            $status = [
                'cancel' => 'Huỷ',
                'handle' => 'Đang xử lý',
            ];
        }
        if ($statusNow == 'handle') {
            $status = [
                'cancel' => 'Huỷ',
                'handle' => 'Đang xử lý',
                'transport' => 'Đang vận chuyển',
            ];
        }
        if ($statusNow == 'transport') {
            $status = [
                'transport' => 'Đang vận chuyển',
                'done' => 'Hoàn thành',
            ];
        }
        if ($statusNow == 'done') {
            $status = [
                'done' => 'Hoàn thành',
            ];
        }
        return $status;
    }
}

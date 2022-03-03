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
    /**
     * Get view & info order with $id
     * @return view
     * @param $id of order
     * **/
    public function edit($id)
    {
        $orders = $this->orderRepo->get()->where('id', $id)->with('user.infomation')->first();
        $orders['status_array'] = $this->handleStatus($orders->status);
        $order_products = $this->orderProductRepo->get()->where('order_id', $id)->with('product')->get();;
        return view('admin.order.edit', compact('orders', 'order_products'));
    }
    /**
     * get list product for update order
     * @return $products
     * @param $request
     * **/
    public function edit_add(Request $request)
    {
        $products = $this->productRepo->get()->query();
        if ($request->has('key')) {
            $key = $request->key;
            $products->where('product_name', 'LIKE', "%{$key}%")
                ->orWhere('product_price', $key);
        }
        $products = $products->paginate(10)->withQueryString();
        $order_id = $request->id;
        return view('admin.order.edit_add', compact('products', 'order_id'));
    }
    /**
     * Handle add product for order
     * @return
     * @param $request
     * **/
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
    /**
     * Handle update quantity product in order
     * @return
     * @param $request
     * **/
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
    /**
     * Handle delete product in order
     * @return
     * @param $request
     * **/
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
    /**
     * Update product in order
     * @return
     * @param $id of order, $product__id, $numOrder, $sub_total
     * **/
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
    /**
     * Update status & info user of order
     * @return
     * @param $id of order, $request
     * **/
    public function update(Request $request, $id)
    {
        $this->orderRepo->update($id, [
            'status' => $request->status,
            'payment' => $request->payment
        ]);
        $user = $this->userRepo->find($request->user_id);
        $order = $this->orderRepo->get()->where('id', $id);
        if ($order->first()->address != null) {
            $order->update([
                'address' => $request->address
            ]);
        } else {
            $user->infomation()->update([
                'address' => $request->address,
            ]);
        }
        $user->infomation()->update([
            'phone' => $request->phone,
            'gender' => $request->gender
        ]);
        return redirect()->back()->with('success', 'Chỉnh sửa đơn hàng thành công');
    }
    /**
     * Get status order with now status
     * @return $status
     * @param $statusNow
     * **/
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

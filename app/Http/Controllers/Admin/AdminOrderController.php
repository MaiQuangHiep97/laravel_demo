<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOrderRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderProduct\OrderProductRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminOrderController extends Controller
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
    public function index(Request $request)
    {
        if ($request->status) {
            $orders = DB::table('orders')->where('status', $request->status)->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.id as user_id', 'users.name', 'users.email')
                ->orderBy('id', 'desc')->paginate(10);
            return view('admin.order.list', compact('orders'));
        }
        if ($request->key) {
            $key = $request->key;
            $orders = $this->search($key, 10);
        } else {
            $orders = DB::table('orders')->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.id as user_id', 'users.name', 'users.email')
                ->orderBy('id', 'desc')->paginate(10);
        }
        return view('admin.order.list', compact('orders'));
    }
    public function search($key, $count)
    {
        return DB::table('orders')->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.id as user_id', 'users.name', 'users.email')
            ->where('orders.code', 'LIKE', "%{$key}%")
            ->orWhere('users.name', 'LIKE', "%{$key}%")
            ->orWhere('users.email', 'LIKE', "%{$key}%")
            ->orderBy('id', 'desc')->paginate($count);
    }
    public function edit($id)
    {
        $orders = $this->orderRepo->get()->where('id', $id)->with('user.infomation')->first();
        $order_products = $this->orderProductRepo->get()->where('order_id', $id)->with('product')->get();;
        return view('admin.order.edit', compact('orders', 'order_products'));
    }
    public function add(Request $request)
    {
        if ($request->key) {
            $key = $request->key;
            $products = $this->search_product($key, 2);
        } else {
            $products = $this->productRepo->get()->paginate(2)->withQueryString();
        }
        return view('admin.order.add', compact('products'));
    }
    public function search_product($key, $count)
    {
        return DB::table('products')
            ->where('product_name', 'LIKE', "%{$key}%")
            ->orWhere('product_price', $key)
            ->paginate($count);
    }
    public function order_cart_add(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'qty' => $request->qty,
            'price' => $request->price,
            'weight' => 0,
            'options' => ['image' => $request->thumb]
        ]);
        return true;
    }
    public function order_cart_show()
    {
        $items = Cart::content();
        return view('admin.order.cart', compact('items'));
    }
    public function order_cart_update(Request $request)
    {
        if ($request->numOrder < 1) {
            Cart::remove($request->id);
            $total = Cart::total();
            $data = [
                'count' => Cart::count(),
                'num_order' => $request->numOrder,
                'id' => $request->product_id,
                'total' => $total,
            ];
        } else {
            Cart::update($request->id, $request->numOrder);
            $item = Cart::get($request->id);
            $sub_total = $item->price * $item->qty;
            $total = Cart::total();
            $data = [
                'count' => Cart::count(),
                'num_order' => $request->numOrder,
                'id' => $item->id,
                'sub_total' => number_format($sub_total) . 'đ',
                'total' => $total,
            ];
        }
        $count = Cart::count();
        if ($count == 0) {
            $data = [
                'count' => $count,
                'display' => "<div class='text-center' style='margin-top: 30px;'>
                <h5>There are no items in the cart </h5>
                <a href='/project_demo/admin/order-add'>Thêm đơn hàng</a>
            </div>"
            ];
        }
        return $data;
    }
    public function order_cart_delete(Request $request)
    {
        Cart::remove($request->id);
        $total = Cart::total();
        $data = [
            'count' => Cart::count(),
            'id' => $request->product_id,
            'total' => $total,
        ];
        if (Cart::count() == 0) {
            $data = [
                'count' => Cart::count(),
                'display' => "<div class='text-center' style='margin-top: 30px;'>
                <h4>There are no items in the cart </h4>
                <a href='/project_demo/admin/order-add'>Thêm đơn hàng</a>
            </div>"
            ];
        }
        return $data;
    }
    public function create(AddOrderRequest $request)
    {
        $id = $this->userRepo->get()->updateOrCreate(
            ['email' => $request->email],
            ['name' => $request->name, 'password' => Hash::make('Hiep0312')]
        )->id;
        $this->infomationRepo->get()->updateOrCreate(
            ['infomationable_id' => $id, 'infomationable_type' => 'App\Models\User'],
            ['address' => $request->address, 'phone' => $request->phone]
        );
        $code = 'GD-' . time();

        $data = [
            'user_id' => $id,
            'payment' => $request->payment,
            'total_price' => $request->total,
            'status' => 'handle',
            'code' => $code
        ];
        $id = $this->orderRepo->get()->insertGetId($data);
        foreach (Cart::content() as $product_order) {
            $this->orderProductRepo->create([
                'order_id' => $id,
                'product_id' => $product_order->id,
                'quantity' => $product_order->qty
            ]);
        }
        Cart::destroy();
        return redirect('admin/list-order')->with('success', 'Thêm đơn hàng thành công');
    }
}

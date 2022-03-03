<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use Gloudemans\Shoppingcart\Calculation\GrossPrice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    /**
     * Get info cart
     * @return info cart
     * @param none
     * **/
    public function index()
    {
        $contents = Cart::content();
        return view('client.cart.show', compact('contents'));
    }
    /**
     * Handle add cart
     * @return
     * @param $request
     * **/
    public function add(Request $request)
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
    /**
     * Handle update info cart
     * @return
     * @param $request
     * **/
    public function update(Request $request)
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
                <h4>There are no items in the cart </h4>
                <a href='http://localhost/project_demo/'>Home page</a>
            </div>"
            ];
        }
        return $data;
    }
    /**
     * Handle delete item cart
     * @return
     * @param $request
     * **/
    public function delete_item(Request $request)
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
                <a href='http://localhost/project_demo/'>Home page</a>
            </div>"
            ];
        }
        return $data;
    }
    /**
     * Handle delete cart
     * @return
     * @param none
     * **/
    public function destroy()
    {
        Cart::destroy();
        $data = [
            'count' => Cart::count(),
            'display' => "<div class='text-center' style='margin-top: 30px;'>
            <h4>There are no items in the cart </h4>
            <a href='http://localhost/project_demo/'>Home page</a>
        </div>"
        ];
        return $data;
    }
}

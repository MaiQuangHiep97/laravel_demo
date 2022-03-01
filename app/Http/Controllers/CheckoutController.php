<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Jobs\SendEmail;
use App\Mail\MailOrder;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderProduct\OrderProductRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    protected $userRepo;
    protected $orderRepo;
    protected $infomationRepo;
    protected $orderProductRepo;
    public function __construct(UserRepositoryInterface $userRepo, OrderRepositoryInterface $orderRepo,
                                 InfomationRepositoryInterface $infomationRepo,
                                 OrderProductRepositoryInterface $orderProductRepo)
    {
        $this->userRepo = $userRepo;
        $this->orderRepo = $orderRepo;
        $this->infomationRepo = $infomationRepo;
        $this->orderProductRepo = $orderProductRepo;
    }
    public function index(){
        $contents = Cart::content();
        $user = $this->userRepo->find(Auth::id());
        $user = $user->load('infomation');
        return view('client.checkout.checkout', compact('contents', 'user'));
    }
    public function checkout(CheckoutRequest $request){
        $this->infomationRepo->get()->updateOrCreate(
            ['infomationable_id'=> $request->user_id, 'infomationable_type'=> 'App\Models\User'],
            ['address' => $request->address, 'phone' => $request->phone]
        );
        $code = 'GD-'.time();
        if(isset($request->address1)){
            $data = [
                'address' => $request->address1,
                'user_id' => $request->user_id,
                'payment' => $request->payment,
                'total_price' => $request->total,
                'status' => 'handle',
                'code' => $code
            ];
        }else{
            $data = [
                'user_id' => $request->user_id,
                'payment' => $request->payment,
                'total_price' => $request->total,
                'status' => 'handle',
                'code' => $code
            ];
        }
        $id = $this->orderRepo->get()->insertGetId($data);
        foreach (Cart::content() as $product_order) {
            $this->orderProductRepo->create([
                'order_id' => $id,
                'product_id' => $product_order->id,
                'quantity' => $product_order->qty
            ]);
        }
        $order = $this->orderRepo->get()->where('id', $id)->with('order_products.product')->first();
        $user = $this->userRepo->find($request->user_id);
        SendEmail::dispatch($order, $user);
        Cart::destroy();
        return redirect('/done');
    }
}

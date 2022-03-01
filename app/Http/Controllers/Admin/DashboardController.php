<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\OrderProduct\OrderProductRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    protected $productRepo;
    protected $orderProductRepo;
    protected $orderRepo;
    public function __construct(
        ProductRepositoryInterface $productRepo,
        OrderProductRepositoryInterface $orderProductRepo,
        OrderRepositoryInterface $orderRepo
    ) {
        $this->productRepo = $productRepo;
        $this->orderProductRepo = $orderProductRepo;
        $this->orderRepo = $orderRepo;
    }
    public function index(Request $request)
    {
        $handle = $this->orderRepo->get()->where('status', 'handle')->count();
        $cancel = $this->orderRepo->get()->where('status', 'cancel')->count();
        $transport = $this->orderRepo->get()->where('status', 'transport')->count();
        $done = $this->orderRepo->get()->where('status', 'done')->count();
        $count = [
            'handle' => $handle,
            'cancel' => $cancel,
            'transport' => $transport,
            'done' => $done,
        ];
        if ($request->key) {
            $key = $request->key;
            $orders = $this->search($key, 10);
        } else {
            $orders = DB::table('orders')->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.id as user_id', 'users.name', 'users.email')
                ->latest()->paginate(10);
        }
        return view('admin.dashboard.dashboard', compact('orders','handle', 'cancel', 'transport', 'done'));
    }
    public function search($key, $count)
    {
        return DB::table('orders')->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.id as user_id', 'users.name', 'users.email')
            ->where('orders.code', 'LIKE', "%{$key}%")
            ->orWhere('users.name', 'LIKE', "%{$key}%")
            ->orWhere('users.email', 'LIKE', "%{$key}%")
            ->latest()->paginate($count);
    }
}

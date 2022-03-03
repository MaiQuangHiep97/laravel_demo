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
    /**
     * Get count order with status
     * @return $count
     * @param none
     * **/
    public function counts(){
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
        return $count;
    }
    /**
     * Get list orders & counts
     * @return $orders & $count
     * @param $request
     * **/
    public function index(Request $request)
    {
        $count = $this->counts();
        $orders = $this->orderRepo->get()->query()->with('user');
        if ($request->has('status')) {
            $orders->where('status', $request->status);
        }
        if ($request->has('key')) {
            $key = $request->key;
            $orders->where('code', 'LIKE', "%{$key}%")
                ->orWhereHas('user', function ($query) use ($key) {
                    $query->where('name', 'LIKE', "%{$key}%")
                        ->orWhere('email', 'LIKE', "%{$key}%");
                });
        }
        $orders = $orders->latest('id')->paginate(10)->withQueryString();
        return view('admin.dashboard.dashboard', compact('orders','count'));
    }
}

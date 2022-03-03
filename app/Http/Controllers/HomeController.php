<?php

namespace App\Http\Controllers;

use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $productRepo;
    public $cateRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepositoryInterface $productRepo, CategoryRepositoryInterface $cateRepo)
    {
        $this->productRepo = $productRepo;
        $this->cateRepo = $cateRepo;
    }

    /**
     * Get list products
     * @return $products
     * @param $request
     * **/
    public function index(Request $request)
    {
        $products = $this->productRepo->get()->query();

        if ($request->has('start_price') && $request->has('end_price')) {
            $products->whereBetween('product_price', [$request->start_price, $request->end_price]);
        }
        if ($request->has('search')) {
            $key = $request->search;
            $products->where('product_name', 'LIKE', "%{$key}%");
        }
        return view('client.home.index')->with('products', $products->paginate(10)->withQueryString());
    }
    /**
     * Get product with category
     * @return $products
     * @param $request & $slug of category
     * **/
    public function show(Request $request, $slug)
    {
        $cate_id = $this->cateRepo->get()->where('slug', $slug)->first()->id;
        $products = $this->productRepo->get()->where('cate_id', $cate_id)->paginate(10)->withQueryString();
        if (isset($request->start_price) && isset($request->end_price)) {
            $products = $this->productRepo->get()->where('cate_id', $cate_id)
                ->whereBetween('product_price', [$request->start_price, $request->end_price])
                ->paginate(10)->withQueryString();
        }
        return view('client.home.index', compact('products'));
    }
}

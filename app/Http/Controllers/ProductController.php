<?php

namespace App\Http\Controllers;

use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }
    /**
     * Get detail product with slug
     * @return $product
     * @param $slug of product
     * **/
    public function index($slug){
        $products = $this->productRepo->getAll();
        $product = $this->productRepo->get()->where('slug', $slug)->first();
        $product = $product->load('product_image');
        return view('client.product.index', compact('product', 'products'));
    }
}

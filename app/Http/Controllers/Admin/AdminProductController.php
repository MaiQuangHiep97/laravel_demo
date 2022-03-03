<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProduct;
use App\Http\Requests\UpdateProduct;
use App\Models\Product_Image;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    protected $productRepo;
    protected $productImageRepo;
    protected $cateRepo;
    public function __construct(
        ProductRepositoryInterface $productRepo,
        CategoryRepositoryInterface $cateRepo,
        ProductImageRepositoryInterface $productImageRepo
    ) {
        $this->productRepo = $productRepo;
        $this->productImageRepo = $productImageRepo;
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
        if ($request->has('sort')) {
            $products->orderBy('product_price', $request->sort);
        }
        if ($request->has('key')) {
            $key = $request->key;
            $products->where('product_name', 'LIKE', "%{$key}%")
            ->orWhere('product_price', $key);
        }
        $products = $products->paginate(10)->withQueryString();
        return view('admin.product.list', compact('products'));
    }
    /**
     * view add product
     * @return view add product
     * @param none
     * **/
    public function add()
    {
        $categories = $this->cateRepo->getAll();
        return view('admin.product.add', compact('categories'));
    }
    /**
     * Handle add product
     * @return
     * @param $request
     * **/
    public function create(AddProduct $request)
    {
        $product_thumb = $request->file('product_thumb')->hashName();
        $data = [
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_detail' => $request->product_detail,
            'product_price' => $request->product_price,
            'cate_id' => $request->product_cate,
            'admin_id' => Auth::guard('admin')->id(),
            'product_thumb' => $product_thumb,
            'slug' => $request->product_slug
        ];
        $id = $this->productRepo->get()->insertGetId($data);
        Storage::putFileAs('products', $request->file('product_thumb'), $product_thumb);
        if ($id) {
            $this->saveMultiFile($request->file('product_images'), $id);
        }
        return redirect('admin/list-product')->with('success', 'Thêm sản phẩm thành công');
    }
    /**
     * Delete product
     * @return
     * @param $id of product
     * **/
    public function delete($id)
    {
        $this->deleteMultiFile($id);
        $this->deleteFile($id);
        return redirect('admin/list-product')->with('success', 'Xoá sản phẩm thành công');
    }
    /**
     * view edit product
     * @return view
     * @param $slug of product
     * **/
    public function edit($slug)
    {
        $categories = $this->cateRepo->getAll();
        $product = $this->productRepo->get()->where('slug', $slug)->first();
        $products = $product->load('product_image');
        return view('admin.product.edit', compact('products', 'categories'));
    }
    /**
     * Handle update product
     * @return
     * @param $id of product & $request
     * **/
    public function update(UpdateProduct $request, $id)
    {
        $product_thumb = $request->file('product_thumb')->hashName();
        $data = [
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'product_detail' => $request->product_detail,
            'product_price' => $request->product_price,
            'cate_id' => $request->product_cate,
            'admin_id' => Auth::guard('admin')->id(),
            'product_thumb' => $product_thumb,
        ];
        $product = $this->productRepo->find($id);
        Storage::delete('products/' . $product->product_thumb);
        $this->productRepo->update($id, $data);
        Storage::putFileAs('products', $request->file('product_thumb'), $product_thumb);
        $this->deleteMultiFile($id);
        $this->saveMultiFile($request->file('product_images'), $id);
        return redirect('admin/list-product')->with('success', 'Cập nhật sản phẩm thành công');
    }
    /**
     * Handle save multiple image
     * @return true false
     * @param $id of product & info image
     * **/
    public function saveMultiFile($files, $id)
    {
        foreach ($files as $file) {
            $product_image = $file->hashName();
            $this->productImageRepo->create([
                'url_image' => $product_image,
                'product_id' => $id
            ]);
            Storage::putFileAs('products', $file, $product_image);
        }
        return true;
    }
    /**
     * Delete image
     * @return true false
     * @param $id of product
     * **/
    public function deleteFile($id)
    {
        $product = $this->productRepo->find($id);
        Storage::delete('products/' . $product->product_thumb);
        $this->productRepo->delete($id);
        return true;
    }
    /**
     * Delete multiple images
     * @return true false
     * @param $id of product
     * **/
    public function deleteMultiFile($id)
    {
        $product_images = $this->productImageRepo->get()->where('product_id', $id)->get();
        foreach ($product_images as $product_image) {
            Storage::delete('products/' . $product_image->url_image);
            $this->productImageRepo->get()->where('product_id', $product_image->product_id)->delete();
        }
        return true;
    }
}

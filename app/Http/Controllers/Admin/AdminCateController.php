<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategory;
use App\Http\Requests\UpdateCategory;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCateController extends Controller
{
    protected $cateRepo;
    public function __construct(CategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }
    public function index(Request $request)
    {
        if($request->key){
            $key = $request->key;
            $cates = $this->cateRepo->get()->where('category_name', 'LIKE', "%{$key}%")->paginate(5)->withQueryString();
        }else{
            $cates = $this->cateRepo->get()->paginate(5)->withQueryString();
        }
        return view('admin.category.list', compact('cates'));
    }
    public function create(AddCategory $request)
    {
        $data = [
            'category_name' => $request->name,
            'admin_id' => Auth::guard('admin')->id(),
            'slug' => $request->cate_slug
        ];
        if ($this->cateRepo->get()->where('category_name', $request->name)->exists()) {
            return redirect()->back()->with('fails', 'Danh mục đã tồn tại');
        } else {
            $this->cateRepo->create($data);
            return redirect()->back()->with('success', 'Thêm danh mục thành công');
        }
    }
    public function delete($id)
    {
        $this->cateRepo->delete($id);
        return redirect()->back()->with('success', 'Xoá danh mục thành công');
    }
    public function edit(Request $request)
    {
        $data = $this->cateRepo->find($request->id);
        return $data;
    }
    public function update(UpdateCategory $request)
    {
        $cate_old = $this->cateRepo->find($request->id)->category_name;
        $check = $this->cateRepo->get()->where('category_name', $request->name)->exists();
        if (($request->name == $cate_old) || !$check) {
            $this->cateRepo->update($request->id, [
                'category_name' => $request->name,
                'admin_id' => Auth::guard('admin')->id(),
            ]);
            return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
        } else {
            return redirect()->back()->with('fails', 'Danh mục đã tồn tại');
        }
    }
}

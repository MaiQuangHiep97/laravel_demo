<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCustomer;
use App\Http\Requests\EditAdminRequest;
use App\Models\Admin;
use App\Models\Infomation;
use App\Repositories\Admin\AdminRepositoryInterface;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    protected $adminRepo;
    protected $infomationRepo;
    public function __construct(AdminRepositoryInterface $adminRepo, InfomationRepositoryInterface $infomationRepo)
    {
        $this->adminRepo = $adminRepo;
        $this->infomationRepo = $infomationRepo;
    }
    public function index(Request $request)
    {
        if ($request->key) {
            $key = $request->key;
            $admins = $this->search($key, 2);
        } else {
            $admins = $this->adminRepo->getWith('infomation', 2);
        }
        return view('admin.admin.list', compact('admins'));
    }
    public function add()
    {
        return view('admin.admin.add');
    }
    public function create(AddCustomer $request)
    {
        $dataAdmin = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        if ($this->adminRepo->get()->where('email', $request->email)->exists()) {
            return redirect()->back()->with('fails', 'Địa chỉ email đã tồn tại');
        } else {
            $id = $this->adminRepo->get()->insertGetId($dataAdmin);
            $dataInfo = [
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'infomationable_id' => $id,
                'infomationable_type' => 'App\Models\Admin'
            ];
            $this->infomationRepo->create($dataInfo);
            return redirect('admin/list-admin')->with('success', 'Thêm admin thành công');
        }
    }
    public function delete($id)
    {
        if (Auth::guard('admin')->id() == $id) {
            return redirect('admin/list-admin')->with('fails', 'Không thể xoá admin này');
        } else {
            $this->adminRepo->delete($id);
            $this->infomationRepo->deleteWhere([['infomationable_id', $id], ['infomationable_type', 'App\Models\Admin']]);
            return redirect('admin/list-admin')->with('success', 'Xoá admin thành công');
        }
    }
    public function edit($id)
    {
        $admin = $this->adminRepo->find($id);
        $admin = $admin->load('infomation');
        return view('admin.admin.edit', compact('admin'));
    }
    public function update(EditAdminRequest $request, $id)
    {
        $email_old = $this->adminRepo->find($id)->email;
        $dataAdmin = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        $dataInfo = [
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
        ];
        if ($request->email == $email_old) {
            $this->updateInfo(
                $id,
                $dataAdmin,
                $dataInfo
            );
            return redirect('admin/list-admin')->with('success', 'Cập nhật admin thành công');
        } else {
            if (Admin::where('email', $request->email)->exists()) {
                return redirect()->back()->with('fails', 'Email đã tồn tại');
            } else {
                $this->updateInfo(
                    $id,
                    $dataAdmin,
                    $dataInfo
                );
                return redirect('admin/list-admin')->with('success', 'Cập nhật admin thành công');
            }
        }
    }
    public function updateInfo($id, $dataAdmin = [], $dataInfo = [])
    {
        $this->adminRepo->update($id, $dataAdmin);
        $this->infomationRepo
            ->updateWhere([['infomationable_id', $id], ['infomationable_type', 'App\Models\Admin']], $dataInfo);
        return true;
    }
    public function search($key, $count)
    {
        return DB::table('admins')
            ->join('infomations', 'admins.id', '=', 'infomations.infomationable_id')
            ->where('infomationable_type', '=', 'App\Models\Admin')
            ->where(function ($query) use ($key) {
                $query->orWhere('name', 'LIKE', "%{$key}%")
                    ->orWhere('email', 'LIKE', "%{$key}%")
                    ->orWhere('phone', 'LIKE', "%{$key}%");
            })->paginate($count);
    }
}

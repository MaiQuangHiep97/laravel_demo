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
    /**
     * Get list admins
     * @return $admins
     * @param $request
     * **/
    public function index(Request $request)
    {
        $admins = $this->adminRepo->get()->query();
        if ($request->has('key')) {
            $key = $request->key;
            $admins->with('infomation')->where('name', 'LIKE', "%{$key}%")
                ->orWhere('email', 'LIKE', "%{$key}%")
                ->orWhereHas('infomation', function ($q) use ($key) {
                    $q->where('phone', 'LIKE', "%{$key}%");
                });
        }
        $admins = $admins->paginate(10)->withQueryString();
        return view('admin.admin.list', compact('admins'));
    }
    /**
     * Get view add admin
     * @return view
     * @param none
     * **/
    public function add()
    {
        return view('admin.admin.add');
    }
    /**
     * Handle add admin
     * @return
     * @param $request
     * **/
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
    /**
     * Delete admin
     * @return true false
     * @param $id of admins
     * **/
    public function delete($id)
    {
        if (Auth::guard('admin')->id() == $id) {
            return redirect('admin/list-admin')->with('fails', 'Không thể xoá admin này');
        } else {
            $admin = $this->adminRepo->find($id);
            $admin->delete();
            $admin->infomation()->delete();
            return redirect('admin/list-admin')->with('success', 'Xoá admin thành công');
        }
    }
    /**
     * Get info admins with $id
     * @return
     * @param $id
     * **/
    public function edit($id)
    {
        $admin = $this->adminRepo->find($id);
        $admin = $admin->load('infomation');
        return view('admin.admin.edit', compact('admin'));
    }
    /**
     * Handle update admin
     * @return
     * @param $request & $id of admin
     * **/
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
    /**
     * Update info of admin
     * @return true
     * @param $id of admin & $dataAdmin & $dataInfo
     * **/
    public function updateInfo($id, $dataAdmin = [], $dataInfo = [])
    {
        $admin = $this->adminRepo->find($id);
        $admin->update($dataAdmin);
        $admin->infomation()->update($dataInfo);
        return true;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCustomer;
use App\Http\Requests\EditAdminRequest;
use App\Models\User;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    protected $userRepo;
    protected $infomationRepo;
    public function __construct(UserRepositoryInterface $userRepo, InfomationRepositoryInterface $infomationRepo)
    {
        $this->userRepo = $userRepo;
        $this->infomationRepo = $infomationRepo;
    }
    public function index(Request $request)
    {
        if ($request->key) {
            $key = $request->key;
            $users = $this->search($key, 10);
        } else {
            $users = $this->userRepo->getWith('infomation', 10);
        }
        return view('admin.user.list', compact('users'));
    }
    public function add()
    {
        return view('admin.user.add');
    }
    public function create(AddCustomer $request)
    {
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        if ($this->userRepo->get()->where('email', $request->email)->exists()) {
            return redirect()->back()->with('fails', 'Địa chỉ email đã tồn tại');
        } else {
            $id = $this->userRepo->get()->insertGetId($dataUser);
            $dataInfo = [
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'infomationable_id' => $id,
                'infomationable_type' => 'App\Models\User'
            ];
            $this->infomationRepo->create($dataInfo);
            return redirect('admin/list-user')->with('success', 'Thêm user thành công');
        }
    }
    public function delete($id)
    {
        $this->userRepo->delete($id);
        $this->infomationRepo->deleteWhere([['infomationable_id', $id], ['infomationable_type', 'App\Models\User']]);
        return redirect('admin/list-user')->with('success', 'Xoá user thành công');
    }
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        $user = $user->load('infomation');
        return view('admin.user.edit', compact('user'));
    }
    public function update(EditAdminRequest $request, $id)
    {
        $email_old = $this->userRepo->find($id)->email;
        $dataUser = [
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
                $dataUser,
                $dataInfo
            );
            return redirect('admin/list-user')->with('success', 'Cập nhật user thành công');
        } else {
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->with('fails', 'Email đã tồn tại');
            } else {
                $this->updateInfo(
                    $id,
                    $dataUser,
                    $dataInfo
                );
                return redirect('admin/list-user')->with('success', 'Cập nhật user thành công');
            }
        }
    }
    public function updateInfo($id, $dataUser = [], $dataInfo = [])
    {
        $this->userRepo->update($id, $dataUser);
        $this->infomationRepo
            ->updateWhere([['infomationable_id', $id], ['infomationable_type', 'App\Models\User']], $dataInfo);
        return true;
    }
    public function search($key, $count)
    {
        return DB::table('users')->select('users.id as id', 'name', 'email')
            ->join('infomations', 'users.id', '=', 'infomations.infomationable_id')
            ->where('infomationable_type', '=', 'App\Models\User')
            ->where(function ($query) use ($key) {
                $query->orWhere('name', 'LIKE', "%{$key}%")
                    ->orWhere('email', 'LIKE', "%{$key}%")
                    ->orWhere('phone', 'LIKE', "%{$key}%");
            })->paginate($count);
    }
}

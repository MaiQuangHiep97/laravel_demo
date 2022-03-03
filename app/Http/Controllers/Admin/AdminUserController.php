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
    /**
     * Get list users
     * @return $users
     * @param $request
     * **/
    public function index(Request $request)
    {
        $users = $this->userRepo->get()->query();
        if ($request->has('key')) {
            $key = $request->key;
            $users->with('infomation')->where('name', 'LIKE', "%{$key}%")
                ->orWhere('email', 'LIKE', "%{$key}%")
                ->orWhereHas('infomation', function ($q) use ($key) {
                    $q->where('phone', 'LIKE', "%{$key}%");
                });
        }
        $users = $users->paginate(10)->withQueryString();
        return view('admin.user.list', compact('users'));
    }
    /**
     * Get view add user
     * @return view
     * @param none
     * **/
    public function add()
    {
        return view('admin.user.add');
    }
    /**
     * Handle add user
     * @return
     * @param $request
     * **/
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
    /**
     * Handle delete user with $id
     * @return
     * @param $id of user
     * **/
    public function delete($id)
    {
        $user = $this->userRepo->find($id);
        $user->delete();
        $user->infomation()->delete();
        return redirect('admin/list-user')->with('success', 'Xoá user thành công');
    }
    /**
     * Get info user with $id
     * @return $user
     * @param $id of user
     * **/
    public function edit($id)
    {
        $user = $this->userRepo->find($id);
        $user = $user->load('infomation');
        return view('admin.user.edit', compact('user'));
    }
    /**
     * Handle update user
     * @return
     * @param $request, $id of user
     * **/
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
    /**
     * Handle update info user in database
     * @return true/fasle
     * @param $id, $dataUser, $dataInfo
     * **/
    public function updateInfo($id, $dataUser = [], $dataInfo = [])
    {
        $user = $this->userRepo->find($id);
        $user->update($dataUser);
        $user->infomation()->update($dataInfo);
        return true;
    }
}

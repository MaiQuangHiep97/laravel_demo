<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePassRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public $userRepo;
    public function __construct(UserRepositoryInterface $userRepo){
        $this->userRepo = $userRepo;
    }
    /**
     * Check login
     * @return
     * @param none
     * **/
    public function getLogin()
    {
        if(Auth::guard('admin')->check()){
            return redirect('/admin');
        }
        return view('admin.auth.login');
    }
    /**
     * Handle login
     * @return
     * @param $request
     * **/
    public function postLogin(LoginRequest $request)
    {
        $remember = $request->has('remember') ? true : false;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return redirect('/admin');
        }
        return redirect('/admin/login')->with('fails', 'Thông tin tài khoản không chính xác');
    }
    /**
     * Get view change password
     * @return view
     * @param none
     * **/
    public function getChange(){
        $user = $this->userRepo->find(Auth::guard('admin')->id());
        return view('admin.auth.change', compact('user'));
    }
    /**
     * Handle change password
     * @return
     * @param $request
     * **/
    public function postChange(ChangePassRequest $request){
        $this->userRepo->get()->where('id', $request->id)->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect('/admin/login')->with('success', 'Thay đổi mật khẩu thành công');
    }
    /**
     * logout admin
     * @return
     * @param none
     * **/
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}

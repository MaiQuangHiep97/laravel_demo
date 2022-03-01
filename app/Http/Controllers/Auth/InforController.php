<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditAdminRequest;
use App\Models\User;
use App\Repositories\Infomation\InfomationRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

class InforController extends Controller
{
    public $userRepo;
    public $infomationRepo;

    public function __construct(UserRepositoryInterface $userRepo, InfomationRepositoryInterface $infomationRepo)
    {
        $this->userRepo = $userRepo;
        $this->infomationRepo = $infomationRepo;
    }
    public function edit($id){
        $user = $this->userRepo->get()->where('id', $id)->with('infomation')->first();
        //return $user;
        return view('auth.info', compact('user'));
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
            return redirect()->back()->with('success', 'Cập nhật user thành công');
        } else {
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->with('fails', 'Email đã tồn tại');
            } else {
                $this->updateInfo(
                    $id,
                    $dataUser,
                    $dataInfo
                );
                return redirect()->back()->with('success', 'Cập nhật user thành công');
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
}

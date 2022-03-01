<?php
namespace App\Repositories\Admin;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminRepository extends BaseRepository implements AdminRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Admin::class;
    }
    public function getWith($with, $count){
        return $this->model->with($with)->paginate($count)->withQueryString();
    }
}

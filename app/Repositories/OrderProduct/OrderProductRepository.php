<?php
namespace App\Repositories\OrderProduct;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class OrderProductRepository extends BaseRepository implements OrderProductRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\OrderProduct::class;
    }
}

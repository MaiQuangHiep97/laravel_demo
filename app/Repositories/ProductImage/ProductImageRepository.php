<?php
namespace App\Repositories\ProductImage;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ProductImageRepository extends BaseRepository implements ProductImageRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Product_Image::class;
    }
}

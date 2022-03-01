<?php
namespace App\Repositories\Infomation;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class InfomationRepository extends BaseRepository implements InfomationRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\Infomation::class;
    }
}

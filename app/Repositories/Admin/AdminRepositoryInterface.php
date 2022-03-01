<?php
namespace App\Repositories\Admin;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface AdminRepositoryInterface extends RepositoryInterface
{
    public function getWith($with, $count);

}

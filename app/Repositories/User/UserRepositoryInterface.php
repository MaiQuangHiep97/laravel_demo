<?php
namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;
use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getWith($with, $count);
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public $userRepo;
    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    /**
     * Redirect login provider
     * @return
     * @param $provider
     * **/
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    /**
     * Handle callback
     * @return
     * @param $provider
     * **/
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);
        return redirect('/');
    }
    /**
     * Handle login user
     * @return $user
     * @param $info user & $provider
     * **/
    function createUser($getInfo, $provider)
    {
        $user = $this->userRepo->get()
            ->where('email', $getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}

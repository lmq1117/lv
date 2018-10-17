<?php

namespace App\Http\Controllers\Web;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{
    public function getSocialRedirect($account)
    {
        try{
            return Socialite::with($account)->redirect();
        } catch (\InvalidArgumentException $e) {
            return redirect('/login');
        }
    }

    /**
     * 从第三方获取用户信息 存在则直接登录 不存在则保存再登录
     * @param $account
     */
    public function getSocialCallback($account)
    {
        //从第三方获取用户信息
        $socialUser = Socialite::with($account)->user();

        $user = User::where('provider_id','=',$socialUser->id)->where('provider','=',$account)->first();
        if($user == null)
        {
            $newUser = new User();
            $newUser->name = $socialUser->getName() ?? '';
            $newUser->password = '';
            $newUser->email = $socialUser->getEmail() == '' ? '' :$socialUser->getEmail();
            $newUser->avatar = $socialUser->getAvatar();
            $newUser->provider = $account;
            $newUser->provider_id = $socialUser->getId();
            $newUser->save();
            $user = $newUser;
        }

        Auth::login($user);
        return redirect('/');
    }
}

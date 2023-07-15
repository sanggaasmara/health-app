<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use Response;

    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('Unauthorized', 401);
            }

            User::find(Auth::user()->id)->update([
                'remember_token' => $token,
            ]);


            return $this->success(['token' => $token], 'Berhasil Login');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
            return $this->success(null, 'Berhasil Logout');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    public function logoutWeb()
    {

        if (Cookie::get('admin_cookie')) {
            return redirect('/login')->withoutCookie('admin_cookie');
        } else {
            return redirect('/login')->withoutCookie('user_cookie');
        }
    }

    public function me()
    {
        try {
            $user = auth()->user();
            return $this->success($user, 'Berhasil Mendapatkan Data User');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }
    }
}

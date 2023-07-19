<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use Response;

    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            // dd(Auth::attempt($credentials));
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->error('Unauthorized', 401);
            }

            $data = User::find(Auth::user()->id)->update([
                'remember_token' => $token,
            ]);

            // $user = Auth

            return $this->success(['token' => $token, 'role' => Auth::user()->roles], 'Berhasil Login');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), $th->getCode());
        }
    }

    public function register(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            return $this->success($user, 'Berhasil Register');
        } catch (\Throwable $th) {
            //throw $th;
            return $this->error($th->getMessage(), 400);
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
            return redirect('/login')->withoutCookie('pasien_cookie');
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

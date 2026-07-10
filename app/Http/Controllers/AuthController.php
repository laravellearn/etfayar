<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login() {
        return view('auth.login');
    }

    public function submit(Request $request): \Illuminate\Http\RedirectResponse {

        if ($this->attemptLogin($request)) {
            return $this->sendSuccessResponse();
        }

        return $this->sendLoginFailResponse();

    }

    private function attemptLogin(Request $request): bool {
        $credentials = $request->only('username', 'password');
        $credentials['status'] = 1;
        return $this->guard()->attempt($credentials);
        //return Auth::attempt($request->only('username', 'password'));
    }

    private function sendSuccessResponse(): \Illuminate\Http\RedirectResponse {
        return redirect()->intended(route('dashboard'));
    }

    private function sendLoginFailResponse(): \Illuminate\Http\RedirectResponse {
        return back()->with('status', 'خطا در ورود اطلاعات!');
    }


    public function logout(): \Illuminate\Http\RedirectResponse {
        session()->invalidate();
        Auth::logout();
        return redirect()->route('login');

    }

    private function guard() {
        return Auth::guard('admin');
    }

}

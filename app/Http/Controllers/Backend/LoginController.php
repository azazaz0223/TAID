<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BackendLoginRequest;
use App\Services\LoginService;

class LoginController extends Controller
{
    public function __construct(
        private LoginService $loginService,
    ) {
    }

    /**
     * Display a login view.
     */
    public function login()
    {
        $this->loginService->logout();
        return view("backend.login.login");
    }

    /**
     * Request login data to server.
     */
    public function logging(BackendLoginRequest $request)
    {
        $isSuccessLogin = $this->loginService->login($request->validated());

        if (!$isSuccessLogin) {
            $error = "帳號密碼錯誤!";
            return redirect()->route("backend.login")->with("error", $error);
        }

        return redirect()->route("backend.index");
    }

    /**
     * logout
     */
    public function logout()
    {
        $this->loginService->logout();
        return redirect()->route("backend.login");
    }
}

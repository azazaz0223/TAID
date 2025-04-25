<?php

namespace App\Services\Backend;

use Illuminate\Support\Facades\Session;

class LoginService
{
    /**
     * 處理登入邏輯
     * @param mixed $request
     * @return bool
     */
    public function login($request): bool
    {
        $isSuccess = auth()->guard("backend")->attempt(['account' => $request['account'], 'password' => $request['password']]);
        if ($isSuccess) {
            return true;
        }

        return false;
    }

    /**
     * 處理登出邏輯
     * @return void
     */
    public function logout()
    {
        auth()->guard("backend")->logout();
    }
}
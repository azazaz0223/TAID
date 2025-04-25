<?php

namespace App\Trait;

trait JsonResponseTrait
{
    /**
     * 定義統一成功回應方法
     *
     * @param mixed $data 資料
     * @param mixed $status HTTP狀態碼
     * @return \Illuminate\Http\Response
     */
    static public function successResponse($data, $status)
    {
        return response(
            [
                'code' => "00",
                'data' => $data,
            ],
            $status
        );
    }

    /**
     * 定義統一錯誤回應方法
     * @param string $message
     * @param mixed $data 資料
     * @param mixed $status HTTP狀態碼
     * @return \Illuminate\Http\Response
     */
    static public function errorResponse($message, $status, $code = null)
    {
        $code = $code ?? $status;

        return response(
            [
                'code' => $code,
                'message' => $message
            ],
            $status
        );
    }
}

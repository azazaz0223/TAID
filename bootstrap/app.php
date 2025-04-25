<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use App\Trait\JsonResponseTrait;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // 1.Model 找不到資源
        $exceptions->render(function (ModelNotFoundException $e) {
            return JsonResponseTrait::errorResponse(
                $e->getMessage(),
                Response::HTTP_NOT_FOUND
            );
        });

        // 2.網址輸入錯誤（新增判斷）
        $exceptions->render(function (NotFoundHttpException $e) {
            return JsonResponseTrait::errorResponse(
                '無法找到此網址',
                Response::HTTP_NOT_FOUND
            );
        });

        // 3.網址不允許該請求動詞
        $exceptions->render(function (MethodNotAllowedHttpException $e) {
            return JsonResponseTrait::errorResponse(
                $e->getMessage(), // 回傳例外內的訊息
                Response::HTTP_METHOD_NOT_ALLOWED
            );
        });

        // 4.攔截權限
        $exceptions->render(function (AccessDeniedHttpException $e, Request $request) {
            if ($request->is('backend/*/api/*')) {
                return JsonResponseTrait::errorResponse(
                    $e->getMessage(),
                    Response::HTTP_FORBIDDEN
                );
            }

            return redirect()->route("backend.index")->with("error", "無此權限");
        });

        // 5.攔截SQL錯誤
        $exceptions->render(function (QueryException $e) {
            return JsonResponseTrait::errorResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        });

        // 6.攔截Request Validation錯誤
        $exceptions->render(function (ValidationException $e) {
            return JsonResponseTrait::errorResponse(
                $e->getMessage(),
                Response::HTTP_BAD_REQUEST
            );
        });
    })->create();

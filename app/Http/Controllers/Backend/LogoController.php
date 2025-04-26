<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateLogoRequest;
use App\Services\Backend\UploadImageService;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function __construct(
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.logo.list");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogoRequest $request)
    {
        $this->uploadImageService->uploadLogo($request->file('logo'));

        return $this->successResponse(null, 200);
    }
}

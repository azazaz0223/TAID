<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateJoinRequest;
use App\Http\Requests\Backend\UploadJoinImageRequest;
use App\Models\Join;
use App\Services\JoinService;
use App\Services\UploadImageService;

class JoinController extends Controller
{
    public function __construct(
        private JoinService $joinService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->joinService->findOne();
        return view('backend.join.list', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJoinRequest $request, Join $join)
    {
        $this->joinService->update($join, $request->all());

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateImageInfo(UploadJoinImageRequest $request, Join $join)
    {
        $data = [];

        if (isset($request['image'])) {
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $this->uploadImageService->uploadImage($request['op'], 'about', $request->file('image'));
            }
        }

        if (isset($request['content_image'])) {
            if ($request->hasFile('content_image') && $request->file('content_image')->isValid()) {
                $content_image = $this->uploadImageService->uploadImage($request['op'] . "content", 'about', $request->file('content_image'));
            }
        }

        switch ($request['op']) {
            case '2':
                if (isset($image)) {
                    $data['image2'] = $image;
                }
                $data['image2_title'] = $request['title'];
                $data['image2_content'] = $request['content'];
                if (isset($content_image)) {
                    $data['image2_content_image'] = $content_image;
                }
                break;

            case '3':
                if (isset($image)) {
                    $data['image3'] = $image;
                }
                $data['image3_title'] = $request['title'];
                $data['image3_content'] = $request['content'];
                if (isset($content_image)) {
                    $data['image3_content_image'] = $content_image;
                }
                break;
        }

        $this->joinService->update($join, $data);

        return $this->successResponse(null, 200);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateAboutRequest;
use App\Http\Requests\Backend\UploadAboutImageRequest;
use App\Models\About;
use App\Services\AboutService;
use App\Services\UploadImageService;

class AboutController extends Controller
{
    public function __construct(
        private AboutService $aboutService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->aboutService->findOne();
        return view('backend.about.list', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAboutRequest $request, About $about)
    {
        $this->aboutService->update($about, $request->all());

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateImageInfo(UploadAboutImageRequest $request, About $about)
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
            case '1':
                if (isset($image)) {
                    $data['image1'] = $image;
                }
                $data['image1_title'] = $request['title'];
                $data['image1_content'] = $request['content'];
                if (isset($content_image)) {
                    $data['image1_content_image'] = $content_image;
                }
                break;

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

        $this->aboutService->update($about, $data);

        return $this->successResponse(null, 200);
    }
}

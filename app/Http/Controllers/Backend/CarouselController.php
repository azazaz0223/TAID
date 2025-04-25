<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateLogoRequest;
use App\Http\Requests\Backend\UpsertCarouselRequest;
use App\Services\Backend\CarouselService;
use App\Services\Backend\UploadImageService;

class CarouselController extends Controller
{
    public function __construct(
        private CarouselService $carouselService,
        private UploadImageService $uploadImageService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = $this->carouselService->findAll();
        return view("backend.carousel.list", ["list" => $list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateLogo(UpdateLogoRequest $request)
    {
        $this->uploadImageService->uploadLogo($request->file('logo'));

        return $this->successResponse(null, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function upsert(UpsertCarouselRequest $request)
    {
        if (isset($request['deletes'])) {
            foreach ($request['deletes'] as $value) {
                try {
                    $this->uploadImageService->deleteImage($value, 'carousel');
                    $this->carouselService->delete($value);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        if (isset($request['updateTitles'])) {
            if ($request->hasFile('updateImages')) {
                $updateImages = $request->file('updateImages');
            }

            if ($request->hasFile('updateContentImages')) {
                $updateContentImages = $request->file('updateContentImages');
            }

            foreach ($request['updateTitles'] as $key => $value) {
                try {
                    $data = [
                        "title" => $value,
                        "subtitle" => $request['updateSubtitles'][$key],
                        "content" => $request['updateContents'][$key],
                        "content_text" => $request['updateContentTexts'][$key]
                    ];

                    $this->carouselService->update($request['updateIds'][$key], $data);

                    if (isset($updateImages[$key]) && $updateImages[$key]->isValid()) {
                        $this->uploadImageService->uploadImage($request['updateIds'][$key], 'carousel', $updateImages[$key]);
                    }

                    if (isset($updateContentImages[$key]) && $updateContentImages[$key]->isValid()) {
                        $this->uploadImageService->uploadImage($request['updateIds'][$key] . "content", 'carousel', $updateContentImages[$key]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        if (isset($request['titles'])) {
            foreach ($request['titles'] as $key => $value) {
                try {
                    $data = [
                        "title" => $value,
                        "subtitle" => $request['subtitles'][$key],
                        "content" => $request['contents'][$key],
                        "content_text" => $request['contentTexts'][$key]
                    ];

                    $carousel = $this->carouselService->create($data);

                    $image_url = $this->uploadImageService->uploadImage($carousel->id, 'carousel', $request['images'][$key]);
                    $this->carouselService->updateImageUrl($carousel->id, $image_url);

                    $content_image_url = $this->uploadImageService->uploadImage($carousel->id . "content", 'carousel', $request['contentImages'][$key]);
                    $this->carouselService->update($carousel->id, ["content_image" => $content_image_url]);

                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        }

        return $this->successResponse(null, 200);
    }
}

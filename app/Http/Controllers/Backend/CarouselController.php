<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateCarouselRequest;
use App\Http\Requests\Backend\UpdateCarouselRequest;
use App\Models\Carousel;
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
        $carousels = $this->carouselService->findAll();
        return view("backend.carousel.list", compact('carousels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCarouselRequest $request)
    {
        $carousel = $this->carouselService->create($request->all());

        $image_url = $this->uploadImageService->uploadImage($carousel->id, 'carousel', $request->file('image'));

        $this->carouselService->updateImageUrl($carousel->id, $image_url);

        return $this->successResponse(null, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Carousel $carousel)
    {
        return $this->successResponse($carousel, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselRequest $request, Carousel $carousel)
    {
        $this->carouselService->update($carousel->id, $request);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->uploadImageService->uploadImage($carousel->id, 'carousel', $request->file('image'));
        }
        return $this->successResponse(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carousel $carousel)
    {
        $is_deleted = $this->carouselService->delete($carousel->id);

        if ($is_deleted) {
            $this->uploadImageService->deleteImage($carousel->id, "carousel");
        }

        return $this->successResponse(null, 200);
    }
}

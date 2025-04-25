<?php

namespace App\Services\Backend;

use App\Repositories\CarouselRepository;

class CarouselService
{
    public function __construct(
        private CarouselRepository $carouselRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->carouselRepository->findAll();
    }

    public function findAll()
    {
        return $this->carouselRepository->findAll();
    }

    public function create($request)
    {
        return $this->carouselRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->carouselRepository->update($id, $request);
    }

    public function updateImageUrl($id, $image)
    {
        return $this->carouselRepository->updateImageUrl($id, $image);
    }

    public function delete($id)
    {
        return $this->carouselRepository->delete($id);
    }
}
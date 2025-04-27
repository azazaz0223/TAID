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
        $data = [
            'name' => $request['name'],
            'link' => $request['link'] === '' ? null : $request['link'],
            'status' => $request['status'],
            'sort' => $request['sort'],
        ];

        return $this->carouselRepository->update($id, $data);
    }

    public function updateImageUrl($id, $image_url)
    {
        $data = ['image' => $image_url];
        return $this->carouselRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->carouselRepository->delete($id);
    }
}
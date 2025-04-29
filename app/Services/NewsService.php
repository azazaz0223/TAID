<?php

namespace App\Services;

use App\Repositories\NewsRepository;

class NewsService
{
    public function __construct(
        private NewsRepository $newsRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->newsRepository->findAllForFront();
    }

    public function findAll()
    {
        return $this->newsRepository->findAll();
    }

    public function create($request)
    {
        return $this->newsRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->newsRepository->update($id, $request);
    }

    public function updateImageUrl($id, $image)
    {
        return $this->newsRepository->updateImageUrl($id, $image);
    }

    public function delete($id)
    {
        return $this->newsRepository->delete($id);
    }
}
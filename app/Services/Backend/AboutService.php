<?php

namespace App\Services\Backend;

use App\Repositories\AboutRepository;

class AboutService
{
    public function __construct(
        private AboutRepository $aboutRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->aboutRepository->findAllForFront();
    }

    public function findOne()
    {
        return $this->aboutRepository->findOne();
    }

    public function update($about, $request)
    {
        return $this->aboutRepository->update($about, $request);
    }
}
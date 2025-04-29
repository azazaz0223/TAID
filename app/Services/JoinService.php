<?php

namespace App\Services;

use App\Repositories\JoinRepository;

class JoinService
{
    public function __construct(
        private JoinRepository $joinRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->joinRepository->findAllForFront();
    }

    public function findOne()
    {
        return $this->joinRepository->findOne();
    }

    public function update($join, $request)
    {
        return $this->joinRepository->update($join, $request);
    }
}
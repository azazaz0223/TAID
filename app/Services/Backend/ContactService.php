<?php

namespace App\Services\Backend;

use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(
        private ContactRepository $contactRepository
    ) {
    }

    public function create($request)
    {
        return $this->contactRepository->create($request);
    }

    public function findAll($request)
    {
        return $this->contactRepository->findAll($request);
    }


    public function update($contact, $request)
    {
        return $this->contactRepository->update($contact, $request);
    }
}
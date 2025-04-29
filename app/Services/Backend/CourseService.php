<?php

namespace App\Services\Backend;

use App\Repositories\CourseRepository;

class CourseService
{
    public function __construct(
        private CourseRepository $courseRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->courseRepository->findAllForFront();
    }

    public function findAll()
    {
        return $this->courseRepository->findAll();
    }

    public function create($request)
    {
        return $this->courseRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->courseRepository->update($id, $request);
    }

    public function updateImageUrl($id, $image)
    {
        return $this->courseRepository->updateImageUrl($id, $image);
    }

    public function delete($id)
    {
        return $this->courseRepository->delete($id);
    }
}
<?php

namespace App\Services\Backend;

use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

    public function findAllForFront()
    {
        return $this->productRepository->findAllForFront();
    }

    public function findAll()
    {
        return $this->productRepository->findAll();
    }

    public function create($request)
    {
        return $this->productRepository->create($request);
    }

    public function update($id, $request)
    {
        return $this->productRepository->update($id, $request);
    }

    public function updateImageUrl($id, $image)
    {
        return $this->productRepository->updateImageUrl($id, $image);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}
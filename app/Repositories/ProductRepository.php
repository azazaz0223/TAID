<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findAllForFront()
    {
        return Product::limit(20)->orderBy('id', 'desc')->get();
    }

    public function findAll()
    {
        return Product::orderBy('id', 'desc')->paginate(20);
    }

    public function create($request)
    {
        try {
            return Product::create($request);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function update($id, $request)
    {
        try {
            return Product::where('id', $id)->update($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateImageUrl($id, $image)
    {
        try {
            Product::where('id', $id)->update([
                'image' => $image
            ]);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            Product::destroy($id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


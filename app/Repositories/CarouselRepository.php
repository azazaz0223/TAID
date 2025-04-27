<?php

namespace App\Repositories;

use App\Models\Carousel;

class CarouselRepository
{
    public function findAll()
    {
        return Carousel::orderByDesc('sort')->paginate(6);
    }

    public function findAllForFrontend()
    {
        return Carousel::where('status', 1)->orderByDesc('sort')->limit(10)->get();
    }

    public function create($request)
    {
        try {
            return Carousel::create($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            return Carousel::where('id', $id)->update($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateImageUrl($id, $image)
    {
        try {
            Carousel::where('id', $id)->update([
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
            Carousel::destroy($id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


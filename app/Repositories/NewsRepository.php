<?php

namespace App\Repositories;

use App\Models\News;

class NewsRepository
{
    public function findAllForFront()
    {
        return News::where('status', 1)->orderBy('sort')->limit(10)->get();
    }

    public function findAll()
    {
        return News::orderBy('sort')->paginate(6);
    }

    public function create($request)
    {
        try {
            return News::create($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            return News::where('id', $id)->update($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateImageUrl($id, $image)
    {
        try {
            News::where('id', $id)->update([
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
            News::destroy($id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


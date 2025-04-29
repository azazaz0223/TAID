<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function findAllForFront()
    {
        return Course::limit(20)->orderBy('id', 'desc')->get();
    }

    public function findAll()
    {
        return Course::orderBy('id', 'desc')->paginate(20);
    }

    public function create($request)
    {
        try {
            return Course::create($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id, $request)
    {
        try {
            return Course::where('id', $id)->update($request);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateImageUrl($id, $image)
    {
        try {
            Course::where('id', $id)->update([
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
            Course::destroy($id);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


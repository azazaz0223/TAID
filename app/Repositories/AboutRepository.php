<?php

namespace App\Repositories;

use App\Models\About;

class AboutRepository
{
    public function findAllForFront()
    {
        return About::limit(20)->orderBy('id', 'desc')->get();
    }

    public function findOne()
    {
        return About::find(1);
    }

    /**
     * @return bool
     */
    public function update($about, $request)
    {
        try {
            About::where('id', $about->id)->update($request);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


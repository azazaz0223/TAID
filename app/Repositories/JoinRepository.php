<?php

namespace App\Repositories;

use App\Models\Join;

class JoinRepository
{
    public function findAllForFront()
    {
        return Join::limit(20)->orderBy('id', 'desc')->get();
    }

    public function findOne()
    {
        return Join::find(1);
    }

    /**
     * @return bool
     */
    public function update($join, $request)
    {
        try {
            Join::where('id', $join->id)->update($request);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


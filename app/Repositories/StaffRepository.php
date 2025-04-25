<?php

namespace App\Repositories;

use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffRepository
{
    /**
     * @return bool
     */
    public function update($staffId, $request)
    {
        try {
            $staff = Staff::findOrFail($staffId);

            $staff->update([
                'password' => Hash::make($request['password'])
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}


<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateStaffPasswordRequest;
use App\Models\Staff;
use App\Services\StaffService;

class StaffController extends Controller
{
    public function __construct(
        private StaffService $staffService,
    ) {
    }

    public function updatePassword(Staff $staff, UpdateStaffPasswordRequest $updateStaffPasswordRequest)
    {
        $this->staffService->update($staff->id, $updateStaffPasswordRequest->all());

        return $this->successResponse(null, 200);
    }
}

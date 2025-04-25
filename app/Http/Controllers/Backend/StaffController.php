<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Services\Backend\StaffService;
use App\Http\Requests\Backend\UpdateStaffPasswordRequest;

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

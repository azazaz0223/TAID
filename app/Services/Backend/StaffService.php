<?php

namespace App\Services\Backend;

use App\Repositories\StaffRepository;

class StaffService
{
    public function __construct(
        private StaffRepository $StaffRepository
    ) {
    }
    /**
     * 修改員工邏輯
     * @param mixed $request
     * @param string $staffId
     * @return bool
     */
    public function update(string $staffId, $request)
    {
        return $this->StaffRepository->update($staffId, $request);
    }
}
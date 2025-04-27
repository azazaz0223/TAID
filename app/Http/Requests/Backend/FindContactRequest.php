<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;

class FindContactRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "started_date" => "nullable|date",
            "ended_date" => "nullable|date",
            "isHandle" => "nullable|numeric",
            "name" => "nullable|string",
            "phone" => "nullable|string",
        ];
    }
}

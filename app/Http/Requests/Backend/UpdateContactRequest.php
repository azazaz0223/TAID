<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;

class UpdateContactRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "note" => "nullable|string",
            "isHandle" => "required|numeric",
        ];
    }
}

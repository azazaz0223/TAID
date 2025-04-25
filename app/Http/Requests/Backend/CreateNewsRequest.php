<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class CreateNewsRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string",
            "content" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg",
            "content_text" => "required|string",
            "content_image" => "required|image|mimes:jpeg,png,jpg",
        ];
    }
}

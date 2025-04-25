<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class CreateProductRequest extends BaseRequest
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
            "subtitle" => "required|string",
            "content" => "required|string",
            "image" => "required|image|mimes:jpeg,png,jpg",
            "content_image" => "required|image|mimes:jpeg,png,jpg",
        ];
    }
}

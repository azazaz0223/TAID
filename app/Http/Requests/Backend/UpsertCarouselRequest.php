<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UpsertCarouselRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "updateIds.*" => "nullable|string",
            "updateTitles.*" => "nullable|string",
            "updateSubtitles.*" => "nullable|string",
            "updateContents.*" => "nullable|string",
            "updateImages.*" => "nullable|image|mimes:jpeg,png,jpg",
            "updateContentTexts.*" => "nullable|string",
            "updateContentImages.*" => "nullable|image|mimes:jpeg,png,jpg",
            "titles.*" => "nullable|string",
            "subtitles.*" => "nullable|string",
            "contents.*" => "nullable|string",
            "images.*" => "nullable|image|mimes:jpeg,png,jpg",
            "contentTexts.*" => "nullable|string",
            "contentImages.*" => "nullable|image|mimes:jpeg,png,jpg",
            "deletes.*" => "nullable|string",
        ];
    }
}

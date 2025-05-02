<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UploadJoinImageRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'op' => ['required', 'string'],
            'title' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image'],
            "content_image" => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        ];

        $dimensions = [
            '1' => 'dimensions:width=1200,height=800',
            '2' => 'dimensions:width=1200,height=800',
        ];

        if (isset($dimensions[$this->op])) {
            $rules['image'][] = $dimensions[$this->op];
        }

        return $rules;
    }

    /**
     * Custom error messages for validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'image.required' => '請上傳圖片。',
            'image.image' => '檔案必須是圖片格式。',
            'image.dimensions' => $this->getDimensionMessage(),
        ];
    }

    private function getDimensionMessage(): string
    {
        $messages = [
            '1' => '圖片尺寸必須是 1200x800 像素。',
            '2' => '圖片尺寸必須是 1200x800 像素。',
        ];

        return $messages[$this->op] ?? '圖片尺寸不符合要求。';
    }
}

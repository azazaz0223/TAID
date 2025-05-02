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
            'image' => ['required', 'image'],
        ];

        $dimensions = [
            '1' => 'dimensions:width=480,height=480',
            '2' => 'dimensions:width=230,height=230',
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
            '1' => '圖片尺寸必須是 480x480 像素。',
            '2' => '圖片尺寸必須是 230x230 像素。',
        ];

        return $messages[$this->op] ?? '圖片尺寸不符合要求。';
    }
}

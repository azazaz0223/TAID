<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UploadAboutImageRequest extends BaseRequest
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
            "content_image" => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'dimensions:width=1200,height=800'],
        ];

        $dimensions = [
            '1' => 'dimensions:width=800,height=1200',
            '2' => 'dimensions:width=1200,height=800',
            '3' => 'dimensions:width=1200,height=800',
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
            'op.required' => '操作參數為必填。',
            'op.string' => '操作參數必須是文字格式。',

            'title.required' => '標題為必填。',
            'title.string' => '標題必須是文字格式。',

            'content.required' => '內文為必填。',
            'content.string' => '內文必須是文字格式。',

            'image.required' => '請上傳圖片。',
            'image.image' => '檔案必須是圖片格式。',
            'image.dimensions' => $this->getDimensionMessage(),

            'content_image.image' => '內容圖片必須是圖片格式。',
            'content_image.mimes' => '內容圖片格式僅限 jpeg、png、jpg。',
            'content_image.dimensions' => '內容圖片尺寸必須為 1200x800 像素。',
        ];
    }

    private function getDimensionMessage(): string
    {
        $messages = [
            '1' => '圖片尺寸必須是 800x1200 像素。',
            '2' => '圖片尺寸必須是 1200x800 像素。',
            '3' => '圖片尺寸必須是 1200x800 像素。',
        ];

        return $messages[$this->op] ?? '圖片尺寸不符合要求。';
    }
}

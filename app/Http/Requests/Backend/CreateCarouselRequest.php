<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class CreateCarouselRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'link' => 'nullable|string',
            'status' => 'required|boolean',
            'sort' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ];
    }

    /**
     * Custom error messages for validation.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '名稱是必填的。',
            'name.string' => '名稱必須是字串。',
            'status.required' => '上架狀態是必填的。',
            'status.boolean' => '上架狀態必須是布林值。',
            'sort.integer' => '排序必須是整數。',
            'sort.min' => '排序不能小於 0。',
            'image.required' => '圖片是必須的。',
            'image.image' => '圖片必須是有效的圖像文件。',
            'image.mimes' => '圖片格式必須是 jpeg、png、jpg 或 gif。',
            'image.max' => '圖片大小不能超過 10MB。',
        ];
    }
}

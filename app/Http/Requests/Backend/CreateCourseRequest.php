<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class CreateCourseRequest extends BaseRequest
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
            "image" => "required|image|mimes:jpeg,png,jpg|dimensions:width=1200,height=800",
            "content_text" => "required|string",
            "content_image" => "required|image|mimes:jpeg,png,jpg|dimensions:width=1200,height=800",
            "status" => "required|in:0,1",
            "sort" => "nullable|integer|min:1",
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            "title.required" => "請填寫消息大標",
            "title.string" => "標題格式錯誤",

            "subtitle.required" => "請填寫消息副標",
            "subtitle.string" => "消息副標格式錯誤",

            "image.required" => "請上傳圖片",
            "image.image" => "圖片必須是圖片格式",
            "image.mimes" => "圖片格式必須是 jpeg、png 或 jpg",
            'image.dimensions' => '圖片尺寸必須是 1900x700 像素。',

            "content_text.required" => "請填寫內文文字",
            "content_text.string" => "內文文字格式錯誤",

            "content_image.required" => "請上傳內文圖片",
            "content_image.image" => "內文圖片必須是圖片格式",
            "content_image.mimes" => "內文圖片格式必須是 jpeg、png 或 jpg",
            'content_image.dimensions' => '圖片尺寸必須是 1900x700 像素。',

            "status.required" => "請選擇狀態",
            "status.in" => "狀態格式錯誤，僅能是 0 或 1",

            "sort.required" => "請填寫排序",
            "sort.integer" => "排序必須是整數",
            "sort.min" => "排序必須是正整數",
        ];
    }
}

<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\BaseRequest;


class UpdateLogoRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "logo" => "required|image|mimes:png|dimensions:width=310,height=51"
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
            'logo.required' => 'logo 是必上傳的。',
            'logo.image' => 'logo 必須是有效的圖像文件。',
            'logo.mimes' => 'logo 格式必須是 png。',
            'logo.dimensions' => 'logo 尺寸必須是 310x51 像素。',
        ];
    }
}

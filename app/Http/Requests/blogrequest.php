<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class blogrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "tittle"=>"required|min:4|max:100",
            "content"=>"required|min:4",
            "category_id"=>"required"
        ];
    }
    public function messages()
    {
        return[
            "tittle.required"=>"標題必填",
            "tittle.min"=>"標題最少4個字符",
            "tittle.max"=>"標題最多100字符",
            "content.required"=>"內容必填",
            "content.min"=>"標題最少四個字符",
            "category_id"=>"分類必填"
        ];
    }
}

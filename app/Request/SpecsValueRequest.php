<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class SpecsValueRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'specs_id' => 'required|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '请输入标题',
            'specs_id.required' => '请选择规格',
            'specs_id.integer' => '规格错误'
        ];
    }
}

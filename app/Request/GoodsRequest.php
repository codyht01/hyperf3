<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class GoodsRequest extends FormRequest
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
            'title' => 'required|max:200',
            'type' => 'required',
            'category_id' => 'required',
            'unit' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '请输入商品名称',
            'type.required' => '请选择商品类型',
            'category_id.required' => '请选择商品分类',
            'unit.required' => '请输入单位'
        ];
    }
}

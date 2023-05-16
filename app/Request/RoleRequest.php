<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class RoleRequest extends FormRequest
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
            'roleName' => 'required|max:100',
            'sort' => 'integer',
            'status' => 'required|in:0,1',
            'description' => 'max:200',
            'id' => 'integer'
        ];
    }

    public function messages(): array
    {
        return [
            'roleName.required' => "请输入角色名称",
            'roleName.max' => "角色名太长",
            'status.required' => '请选择状态',
            'status.in' => '状态格式不正确',
            'description.max' => '描述太长',
            'id.integer' => 'id格式错误'
        ];
    }
}

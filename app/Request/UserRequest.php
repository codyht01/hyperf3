<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            "userName" => "required|max:30",
            "email" => "required|email",
            "phone" => "required"
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            "userName.required" => "请输入用户名",
            "userName.max" => "用户名最长不能超过30位",
            "email.email" => "请输入正确的邮箱",
            "email.required" => "请输入邮箱地址",
            "phone.required" => "请输入手机号"
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


}

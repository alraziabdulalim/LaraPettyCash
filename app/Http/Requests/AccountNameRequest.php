<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountNameRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:account_names,name',
            'name_bn' => 'required|string|max:255|unique:account_names,name_bn',
            'parent_id' => 'nullable|exists:account_names,id',
            'trans_type' => 'required|string|max:255',
            'account_group' => 'required|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductDetailRequest extends FormRequest
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
            'details.*.value' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'details.*.value.required' => 'Value field is required',
            'details.*.value.max' => 'Value field cannot greater than 255 characters'
        ];
    }
}

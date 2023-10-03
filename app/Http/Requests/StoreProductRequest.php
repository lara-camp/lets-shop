<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => "required|min:3|max:100|unique:products,name",
            'description' => 'required|min:10|max:1000',
            'price' => 'required|numeric|min:500|max:10000000',
            'stock' => 'required|numeric|min:1',
            'category' => 'required',
        ];
    }
}

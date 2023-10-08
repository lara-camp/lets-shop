<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductImageRequest extends FormRequest
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
            'images.*' => 'required|image|dimensions:min_width=800,min_height=800|mimes:jpg,png,jpeg,jpe'
        ];
    }

    public function messages()
    {
        return [
            'images.*.required' => 'The image has invalid image dimension'
        ];
    }
}

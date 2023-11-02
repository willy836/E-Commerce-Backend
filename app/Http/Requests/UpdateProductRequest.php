<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => ['sometimes', 'exists:product_categories,id'],
            'name' => ['sometimes', 'string', 'max:255'],
            'images' => ['sometimes', 'array'],
            'images.*' => ['sometimes', 'url'],
            'description' => ['sometimes', 'string'],
            'price' => ['sometimes', 'integer', 'min:0'],
            'quantity' => ['sometimes', 'integer', 'min:0'],
            'sku' => ['sometimes', 'string'],
            'weight' => ['sometimes', 'numeric', 'min:0']
        ];
    }
}

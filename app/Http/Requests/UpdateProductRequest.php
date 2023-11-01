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
            'user_id' => ['required', 'exists:users, id'],
            'category_id' => ['required', 'exists:product_categories, id'],
            'name' => ['required', 'string', 'max:255'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'url'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'quantity' => ['required', 'integer', 'min:0'],
            'sku' => ['required', 'string'],
            'weight' => ['required', 'numeric', 'min:0']
        ];
    }
}
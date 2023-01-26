<?php

namespace App\Http\Requests\Dashboard\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'name' => 'required|string|max:255',
          'description' => 'required|string',
          'price' => 'nullable|numeric',
          'category_id' => 'required|numeric|exists:categories,id',
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          'discount_price' => 'nullable|numeric',
            'colors' => 'nullable|array',
            'colors.*' => 'nullable|string',
            'sizes' => 'nullable|array',
            'sizes.*' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'quantity' =>'nullable|numeric'
        ];
    }
}

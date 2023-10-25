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
            'name' => 'nullable|unique:products,name',
            'actual_price' => 'nullable|numeric|min:1',
            'sale_price' => 'nullable|numeric|gt:actual_price',
            'brand_id' => 'nullable|exists:brands,id',
            'total_stock' => "nullable|numeric",
            'photo' => "nullable|file",
            'unit' => 'nullable|in:single,dozen'

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopNowFormRequest extends FormRequest
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
            'name' => [
                'required'
            ],
            'payment_mode' => [
                'required'
            ],
            'newPhone' => [
                'nullable',
                'max:10',
                'min:10'
            ],
            'address' => [
                'required'
            ],
            'newPin' => [
                'nullable',
                'max:6',
                'min:6'
            ],
            'product_size' => [
                'required'
            ],
            'quantity' => [
                'required'
            ],
        ];
    }
}

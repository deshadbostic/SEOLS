<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'Name' => 'required|regex:~[a-zA-Z0-9()-:.,]+$~',
            'Price' => 'required|numeric',
            'Quantity' => 'required|integer',
            'Category' => 'required|regex:~[a-zA-Z0-9()-:.,xX]+$~',
        ];
    }
}

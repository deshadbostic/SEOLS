<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BatteryRequest extends FormRequest
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
            'Model' => 'required|regex:~[a-zA-Z0-9()-:.,]+$~',
            'CapacityAh' => 'required|numeric',
            'VoltageV' => 'required|regex:~[a-zA-Z0-9()-:.,]+$~',
            'RatingWh' => 'required|numeric',
            'WeightLbs' => 'required|numeric',
            'Cost' => 'required|numeric',
        ];
    }
}

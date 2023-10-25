<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InverterRequest extends FormRequest
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
            'InputPowerWatts' => 'required|numeric',
            'OutputPowerWatts' => 'required|numeric',
            'SizeInches' => 'required|regex:~[a-zA-Z0-9()-:.,xX]+$~',
            'FrequencyHz' => 'required|regex:~[a-zA-Z0-9()-:.,]+$~',
            'Efficiency' => 'required|numeric',
            'Cost' => 'required|numeric',
        ];
    }
}

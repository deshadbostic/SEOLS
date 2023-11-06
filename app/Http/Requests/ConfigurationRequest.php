<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ConfigurationRequest extends FormRequest
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
            'solar_panel_id' => 'required',
            'solar_panel_count' => 'required|numeric',
            'inverter_id' => 'required',
            'inverter_count' => 'required|numeric',
            'wire_id' => 'required',
            'wire_count' => 'required|numeric',
            'budget' => 'required',
            'energy_requirement' => '',
        ];
    }
}

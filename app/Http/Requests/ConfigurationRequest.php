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
            'solar_panel_id' => ['required'],
            'solar_panel_count' => ['required', 'numeric', 'min:1', 'max:100'],
            'inverter_id' => 'required',
            'inverter_count' => ['required', 'numeric', 'min:1', 'max:100'],
            'wire_id' => 'required',
            'wire_count' => ['required', 'numeric', 'min:1', 'max:100'],
            'budget' => 'required',
            'energy_requirement' => '',
            'battery_count' => 'numeric|min:0'
        ];
    }
}

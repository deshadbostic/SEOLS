<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use Illuminate\Validation\Rules;

use App\Rules as R;
use App\Rules\AlphaSpace;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // if the user id exists in the table, also make the rule ignore it
        // if it doesn't exist the ignore is not added; if the user id doesnt already exist the ignore function will throw an error
        $email_unique_rule = isset($this->user()->id) ? Rule::unique(User::class)->ignore($this->user()->id) : Rule::unique(User::class);

        return [
            'username' => ['alpha_num', 'max:25', 'min:3'],
            'email' => ['email', 'max:255', $email_unique_rule],
            'password' => ['confirmed', Rules\Password::defaults(), 'max:255'],
            'role' => ['alpha', 'max:40'],
            'first_name' => [new R\AlphaNumericSpace('+*-'), 'nullable', 'max:25'],
            'last_name' => [new AlphaSpace(['+', '*', '-']), 'nullable', 'max:25'],
            'address' => ['string', 'nullable', 'min:10', 'max:255'],
            'phone' => ['regex:/^(\+\d{1,2} )?\(\d{1,4}\) \d{3}-\d{4}/', 'nullable'],
            'budget' => ['numeric', 'nullable', 'decimal:0,2', 'regex:/^\d{0,10}(\.\d{0,2})?$/'],
        ];
    }
}

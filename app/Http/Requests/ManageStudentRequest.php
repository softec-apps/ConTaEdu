<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageStudentRequest extends FormRequest
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
        $rules = [
            'ci' => ['required', 'string', 'max:13', 'unique:users,ci,' . $this->route('id')],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->route('id')],
        ];

        if ($this->input('password')) {
            $rules['password'] = ['string', 'min:8', 'confirmed'];
        }

        return $rules;
    }
}

<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class HostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return $this->isMethod('post') ? $this->createRules() : $this->updateRules();
    }

    public function createRules() :array {
        return [
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',
            'email' => 'required',
            'password' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'govs_id' => 'required',
            'policy' => 'required',
        ];
    }

    public function updateRules() :array {
        return [
            'params.data.first_name' => 'required|max:50',
            'params.data.last_name' => 'required|max:50',
            'params.data.email' => 'required',
            'params.data.password' => 'required',
            'params.data.location' => 'required',
            'params.data.contact' => 'required',
            'params.data.gov_id' => 'required',
            'params.data.policy' => 'required',
        ];
    }
}

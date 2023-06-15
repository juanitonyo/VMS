<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

    public function createRules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ];
    }

    public function updateRules(): array
    {
        return [
            'params.data.name' => 'required|max:100|unique:users,id,'.$this->get('id'),
            'params.data.email' => 'required',
            'params.data.role_id' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class InvitationLogsRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'building_id' => 'required',
            'visit_purpose_id' => 'required',
            'user_id' => 'required',
            'location' => 'required',
            'contact' => 'required',
            'target_date' => 'required',
            'status' => 'required'
        ];
    }

    public function updateRules(): array
    {
        return [
            'params.data.first_name' => 'required',
            'params.data.last_name' => 'required',
            'params.data.email' => 'required',
            'params.data.building_id' => 'required',
            'params.data.visit_purpose_id' => 'required',
            'params.data.user_id' => 'required',
            'params.data.location' => 'required',
            'params.data.contact' => 'required',
            'params.data.target_date' => 'required',
            'params.data.status' => 'required',  
        ];
    }

    public function messages()
    {
        return [
            'building_id' => 'The building field is required.',
            'visit_purpose_id' => 'The visit purpose field is required.',
            'user_id' => 'The user field is required.',
        ];
    }
}

<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SMSTemplateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return $this->isMethod('post') ? $this->createRules() : $this->updateRules();
    }

    public function createRules() :array {
        return [
            'message' => 'required|unique:s_m_s_templates|max:100',
            'description' => 'required',
            'status' => 'required',
        ];
    }

    public function updateRules(){
        return [
            'params.data.message' => 'required|max:100|unique:s_m_s_templates, id,'.$this->get('id'),
            'params.data.description' => 'required',
            'params.data.status' => 'required',
        ];
    }
}

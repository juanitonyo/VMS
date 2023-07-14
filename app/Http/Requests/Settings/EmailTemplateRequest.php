<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateRequest extends FormRequest
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
            'purpose' => 'required|unique:email_templates|max:100',
            'subject' => 'required',
            'body' => 'required',
            'description' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'params.data.purpose' => 'required|max:100|unique:email_templates,id,'.$this->get('id'),
            'params.data.subject' => 'required',
            'params.data.body' => 'required',
            'params.data.description' => 'required'
        ];
    }

}

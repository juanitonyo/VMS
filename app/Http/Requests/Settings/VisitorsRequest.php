<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class VisitorsRequest extends FormRequest
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
            'email' => 'required|unique:visitors|max:100',
            'refId' => 'required',
            'name' => 'required',
            'contact' => 'required',
            'validId' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'params.data.email' => 'required|max:100|unique:visitors,id,'.$this->get('id'),
            'params.data.refId' => 'required',
            'params.data.name' => 'required',
            'params.data.contact' => 'required',
            'params.data.validId' => 'required',
        ];
    }
}

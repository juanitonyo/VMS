<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class VisitorLogsRequests extends FormRequest
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
            'visitor_id' => 'required',
            'building_id' => 'required',
            'visitPurpose_id' => 'required',
            'logType' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'params.data.visitor_id' => 'required',
            'params.data.building_id' => 'required',
            'params.data.visitPurpose_id' => 'required',
            'params.data.logType' => 'required'
        ];
    }
}

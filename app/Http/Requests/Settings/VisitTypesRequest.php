<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class VisitTypesRequest extends FormRequest
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
            'name' => 'required',
            'buildingType' => 'required',
            'description' => 'required',
            'personToVisit' => 'required',
            'visitApproval' => 'required',
            'autoApprove' => 'required',
            'status' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'params.data.name'  => 'required',
            'params.data.buildingType' => 'required',
            'params.data.description' => 'required',
            'params.data.personToVisit' => 'required',
            'params.data.visitApproval' => 'required',
            'params.data.autoApprove' => 'required',
            'params.data.status' => 'required'
        ];
    }
}

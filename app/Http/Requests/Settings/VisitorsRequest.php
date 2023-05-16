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
            'name' => 'required',
            'building_ID' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'validId' => 'required',
            'front_id' => 'required',
            'back_id' => 'required',
            'policy' => 'required'
        ];
    }

    public function updateRules(){
        return [
            'params.data.name' => 'required',
            'params.data.building_ID' => 'required',
            'params.data.email' => 'required',
            'params.data.contact' => 'required',
            'params.data.validId' => 'required',
            'params.data.front_id' => 'required',
            'params.data.back_id' => 'required',
            'params.data.policy' => 'required'
        ];
    }
}

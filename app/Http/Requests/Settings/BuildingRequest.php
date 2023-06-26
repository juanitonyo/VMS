<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class BuildingRequest extends FormRequest
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
            'building_name' => 'required|unique:buildings|max:100',
            'address' => 'required',
            'building_type' => 'required',
            'description' => 'required',
            'status' => 'required',
            'health_form' => 'required',
            
        ];
    }

    public function updateRules(){
        return [
            'params.data.building_name' => 'required|max:100|unique:buildings,id'.$this->get('id'),
            'params.data.address' => 'required',
            'params.data.building_type' => 'required',
            'params.data.description' => 'required',
            'params.data.status' => 'required',
            'params.data.health_form' => 'required',
        ];
    }
}

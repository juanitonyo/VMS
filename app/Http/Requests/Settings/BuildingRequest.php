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
            'buildingName' => 'required|unique:buildings|max:100',
            'description' => 'required',
            'address' => 'required',
            'buildingType' => 'required',
            'buildingType' => 'required|max:100',
            'status' => 'required',
        ];
    }

    public function updateRules(){
        return [
            'params.data.buildingName' => 'required|max:100|unique:buildings, id'.$this->get('id'),
            'params.data.description' => 'required',
            'params.data.address' => 'address',
            'params.data.buildingType' => 'required',
            'params.data.status' => 'required',
        ];
    }
}

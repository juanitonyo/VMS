<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class BuildingTypeRequest extends FormRequest
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
            'name' => 'required|unique:building_types|max:100',
            'description' => 'required',
            'delivery_form' => 'required',
            'status' => 'required',
        ];
    }

    public function updateRules(){
        return [
            'params.data.name' => 'required|max:100|unique:building_types,id,'.$this->get('id'),
            'params.data.description' => 'required',
            'params.data.delivery_form' => 'required',
            'params.data.status' => 'required',
        ];
    }


}

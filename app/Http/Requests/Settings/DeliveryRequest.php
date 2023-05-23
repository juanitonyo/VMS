<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            'courierName' => 'required',
            'riderName' => 'required',
            'contact' => 'required|unique:deliveries|max:100',

        ];
    }

    public function updateRules(){
        return [
            'params.data.courierName' => 'required',
            'params.data.riderName' => 'required',
            'params.data.contact' => 'required|max:100|unique:deliveries,id,'.$this->get('id')
        ];
    }
}

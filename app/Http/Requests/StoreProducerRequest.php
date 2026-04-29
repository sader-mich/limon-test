<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'documento_id' => 'required|unique:producers,documento_id',
            'municipio_id' => 'required|string|max:100',
            'localidad_id' => 'required|string|max:100',
            'fecha_alta' => 'required|date',
            'huerto' => 'required|string|max:45',
            'latitud' => 'required|numeric|min:-90|max:90',
            'longitud' => 'required|numeric|min:-180|max:180',
            'no_ha' => 'required|numeric|min:0.1',
            'edad_siembra' => 'required|string|max:25',
            'especie' => 'required|string|max:50',
            'propia_renta' => 'required|string|max:25',
            'vencimiento' => 'required|string|max:35',
            'toneladas' => 'required|numeric|min:1'
        ];
    }
}

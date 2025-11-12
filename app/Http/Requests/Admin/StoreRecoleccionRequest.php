<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecoleccionRequest extends FormRequest
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
            'participante_id' => ['required', 'exists:participantes,id'],
            'material_precio_id' => ['required', 'exists:material_precio,id'],
            'cantidad_kilogramos' => ['required', 'numeric', 'min:0.01'],
            'fecha' => ['required', 'date'],
            'estado' => ['required', 'in:Pendiente,Validado,Rechazado'],
            'proyecto_id' => ['nullable', 'exists:proyectos,id'],
            'institucion_id' => ['nullable', 'exists:instituciones,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'participante_id.required' => 'Debe seleccionar un participante.',
            'participante_id.exists' => 'El participante seleccionado no existe.',
            'material_precio_id.required' => 'Debe seleccionar un material.',
            'material_precio_id.exists' => 'El material seleccionado no existe.',
            'cantidad_kilogramos.required' => 'La cantidad en kilogramos es obligatoria.',
            'cantidad_kilogramos.numeric' => 'La cantidad debe ser un número válido.',
            'cantidad_kilogramos.min' => 'La cantidad debe ser mayor a 0.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser: Pendiente, Validado o Rechazado.',
        ];
    }
}

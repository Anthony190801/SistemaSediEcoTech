<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateParticipanteRequest extends FormRequest
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
            'institucion_proyecto_id' => ['required', 'exists:institucion_proyecto,id'],
            'nivel_academico' => ['required', 'string', 'max:255'],
            'ciclo_o_grado' => ['nullable', 'string', 'max:255'],
            'aula' => ['nullable', 'string', 'max:255'],
            'anio' => ['nullable', 'integer', 'min:2000', 'max:2100'],
            'puntaje_total' => ['nullable', 'numeric', 'min:0'],
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
            'institucion_proyecto_id.required' => 'Debe seleccionar una institución-proyecto.',
            'institucion_proyecto_id.exists' => 'La institución-proyecto seleccionada no existe.',
            'nivel_academico.required' => 'El nivel académico es obligatorio.',
            'nivel_academico.max' => 'El nivel académico no puede exceder 255 caracteres.',
            'ciclo_o_grado.max' => 'El ciclo o grado no puede exceder 255 caracteres.',
            'aula.max' => 'El aula no puede exceder 255 caracteres.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser mayor o igual a 2000.',
            'anio.max' => 'El año debe ser menor o igual a 2100.',
            'puntaje_total.numeric' => 'El puntaje total debe ser un número.',
            'puntaje_total.min' => 'El puntaje total no puede ser negativo.',
        ];
    }
}

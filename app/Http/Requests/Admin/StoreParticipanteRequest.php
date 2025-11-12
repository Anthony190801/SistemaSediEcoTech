<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipanteRequest extends FormRequest
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
            'persona_id' => ['required', 'exists:personas,id'],
            'nivel_academico' => ['required', 'in:Inicial,Primaria,Secundaria,Universitario'],
            'ciclo_o_grado' => ['required', 'integer', 'min:1', 'max:20'],
            'aula' => ['required', 'string', 'max:10'],
            'anio' => ['required', 'integer', 'min:2000', 'max:2100'],
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
            'persona_id.required' => 'Debe seleccionar una persona.',
            'persona_id.exists' => 'La persona seleccionada no existe.',
            'nivel_academico.required' => 'El nivel académico es obligatorio.',
            'nivel_academico.in' => 'El nivel académico debe ser: Inicial, Primaria, Secundaria o Universitario.',
            'ciclo_o_grado.required' => 'El ciclo o grado es obligatorio.',
            'ciclo_o_grado.integer' => 'El ciclo o grado debe ser un número entero.',
            'ciclo_o_grado.min' => 'El ciclo o grado debe ser mayor o igual a 1.',
            'ciclo_o_grado.max' => 'El ciclo o grado debe ser menor o igual a 20.',
            'aula.required' => 'El aula es obligatoria.',
            'aula.max' => 'El aula no puede exceder 10 caracteres.',
            'anio.required' => 'El año es obligatorio.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser mayor o igual a 2000.',
            'anio.max' => 'El año debe ser menor o igual a 2100.',
        ];
    }
}

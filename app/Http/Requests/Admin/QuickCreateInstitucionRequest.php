<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QuickCreateInstitucionRequest extends FormRequest
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
            'proyecto_id' => ['required', 'exists:proyectos,id'],
            'nombre' => ['required', 'string', 'max:255', 'unique:instituciones,nombre'],
            'direccion' => ['required', 'string', 'max:300'],
            'nivel' => ['required', 'in:Educacion Basica,Educacion Media Superior,Educacion Superior'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after:fecha_inicio'],
            'estado' => ['required', 'in:Iniciado,En Pausa,Finalizado'],
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
            'nombre.required' => 'El nombre de la institución es obligatorio.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
            'nombre.unique' => 'Ya existe una institución con ese nombre.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.max' => 'La dirección no debe superar los 300 caracteres.',
            'nivel.required' => 'El nivel educativo es obligatorio.',
            'nivel.in' => 'El nivel educativo debe ser: Educacion Basica, Educacion Media Superior o Educacion Superior.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser: Iniciado, En Pausa o Finalizado.',
        ];
    }
}

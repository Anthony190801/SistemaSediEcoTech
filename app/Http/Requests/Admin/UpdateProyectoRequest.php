<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'estado' => ['required', 'in:Activo,Inactivo'],
            'instituciones' => ['nullable', 'array'],
            'instituciones.*.id' => ['required', 'exists:instituciones,id'],
            'instituciones.*.fecha_inicio' => ['required', 'date'],
            'instituciones.*.fecha_fin' => ['nullable', 'date', 'after:instituciones.*.fecha_inicio'],
            'instituciones.*.estado' => ['required', 'in:Iniciado,En Pausa,Finalizado'],
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
            'nombre.required' => 'El nombre del proyecto es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 255 caracteres.',
            'logo.image' => 'El archivo debe ser una imagen válida.',
            'logo.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o webp.',
            'logo.max' => 'La imagen no puede exceder 2MB.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser Activo o Inactivo.',
            'instituciones.*.id.required' => 'Debe seleccionar una institución.',
            'instituciones.*.id.exists' => 'La institución seleccionada no existe.',
            'instituciones.*.fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'instituciones.*.fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'instituciones.*.fecha_fin.date' => 'La fecha de fin debe ser una fecha válida.',
            'instituciones.*.fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de inicio.',
            'instituciones.*.estado.required' => 'El estado de la relación es obligatorio.',
            'instituciones.*.estado.in' => 'El estado debe ser: Iniciado, En Pausa o Finalizado.',
        ];
    }
}

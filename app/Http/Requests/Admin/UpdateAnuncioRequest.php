<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnuncioRequest extends FormRequest
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
            'motivo' => ['required', 'string', 'max:500'],
            'fecha' => ['nullable', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'lugar' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'in:Activo,Inactivo'],
            'fecha_inicial' => ['required', 'date'],
            'fecha_final' => ['required', 'date', 'after:fecha_inicial'],
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
            'institucion_proyecto_id.required' => 'Debe seleccionar una institución y proyecto.',
            'institucion_proyecto_id.exists' => 'La institución-proyecto seleccionada no existe.',
            'motivo.required' => 'El motivo o título del anuncio es obligatorio.',
            'motivo.max' => 'El motivo no debe superar los 500 caracteres.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'hora.required' => 'La hora del evento es obligatoria.',
            'hora.date_format' => 'La hora debe tener el formato HH:mm.',
            'lugar.max' => 'El lugar no debe superar los 255 caracteres.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser: Activo o Inactivo.',
            'fecha_inicial.required' => 'La fecha inicial de publicación es obligatoria.',
            'fecha_inicial.date' => 'La fecha inicial debe ser una fecha válida.',
            'fecha_final.required' => 'La fecha final de publicación es obligatoria.',
            'fecha_final.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_final.after' => 'La fecha final debe ser posterior a la fecha inicial.',
        ];
    }
}

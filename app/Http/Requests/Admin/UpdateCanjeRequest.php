<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCanjeRequest extends FormRequest
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
        $rules = [
            'estado' => ['required', 'in:Pendiente,Programado,Entregado'],
        ];

        // Si el estado es Programado, validar campos de respuesta
        if ($this->input('estado') === 'Programado') {
            $rules['lugar'] = ['required', 'string', 'max:255'];
            $rules['fecha_programada'] = ['required', 'date'];
            $rules['hora'] = ['required', 'date_format:H:i'];
        }

        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser: Pendiente, Programado o Entregado.',
            'lugar.required' => 'El lugar de entrega es obligatorio cuando se programa.',
            'lugar.max' => 'El lugar no puede exceder 255 caracteres.',
            'fecha_programada.required' => 'La fecha programada es obligatoria cuando se programa.',
            'fecha_programada.date' => 'La fecha programada debe ser una fecha válida.',
            'hora.required' => 'La hora es obligatoria cuando se programa.',
            'hora.date_format' => 'La hora debe tener el formato HH:mm.',
        ];
    }
}

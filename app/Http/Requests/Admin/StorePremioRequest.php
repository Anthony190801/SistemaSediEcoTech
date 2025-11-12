<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePremioRequest extends FormRequest
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
            'articulo_id' => ['required', 'exists:articulos,id'],
            'institucion_proyecto_id' => ['required', 'exists:institucion_proyecto,id'],
            'tipo' => ['required', 'in:Canje por puntaje,Canje por Ranking'],
            'estado' => ['required', 'in:Disponible,No disponible'],
        ];

        // Validación condicional según el tipo
        if ($this->input('tipo') === 'Canje por puntaje') {
            $rules['puntaje_requerido'] = ['required', 'numeric', 'min:0'];
            $rules['posicion_requerida'] = ['nullable'];
        } else {
            $rules['posicion_requerida'] = ['required', 'integer', 'min:1'];
            $rules['puntaje_requerido'] = ['nullable'];
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
            'articulo_id.required' => 'Debe seleccionar un artículo.',
            'articulo_id.exists' => 'El artículo seleccionado no existe.',
            'institucion_proyecto_id.required' => 'Debe seleccionar una institución-proyecto.',
            'institucion_proyecto_id.exists' => 'La institución-proyecto seleccionada no existe.',
            'tipo.required' => 'El tipo de canje es obligatorio.',
            'tipo.in' => 'El tipo debe ser "Canje por puntaje" o "Canje por Ranking".',
            'puntaje_requerido.required' => 'El puntaje requerido es obligatorio para premios por puntaje.',
            'puntaje_requerido.numeric' => 'El puntaje requerido debe ser un número.',
            'puntaje_requerido.min' => 'El puntaje requerido no puede ser negativo.',
            'posicion_requerida.required' => 'La posición requerida es obligatoria para premios por ranking.',
            'posicion_requerida.integer' => 'La posición requerida debe ser un número entero.',
            'posicion_requerida.min' => 'La posición requerida debe ser al menos 1.',
            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser "Disponible" o "No disponible".',
        ];
    }
}

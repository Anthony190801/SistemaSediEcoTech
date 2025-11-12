<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaterialRequest extends FormRequest
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
        $materialId = $this->route('material')?->id;

        return [
            'nombre' => ['required', 'string', 'max:255', Rule::unique('materiales', 'nombre')->ignore($materialId)],
            'url_foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
            'nombre.required' => 'El nombre del material es obligatorio.',
            'nombre.unique' => 'Ya existe un material con este nombre.',
            'url_foto.image' => 'El archivo debe ser una imagen válida.',
            'url_foto.max' => 'La imagen no debe superar los 2MB.',
        ];
    }
}

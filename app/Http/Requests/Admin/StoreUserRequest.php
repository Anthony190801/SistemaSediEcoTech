<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        // Si se proporciona persona_id, no se requieren los campos de persona
        if ($this->filled('persona_id')) {
            return [
                'persona_id' => ['required', 'exists:personas,id'],
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'rol' => ['required', Rule::in(['Administrador', 'Usuario'])],
                'status_user' => ['required', Rule::in(['Activo', 'Inactivo', 'Eliminado'])],
                'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            ];
        }

        // Si no se proporciona persona_id, se requieren todos los campos de persona
        return [
            'dni' => ['required', 'string', 'size:8', 'unique:personas,dni'],
            'nombres' => ['required', 'string', 'max:150'],
            'apellidos' => ['required', 'string', 'max:150'],
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino'])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required', Rule::in(['Administrador', 'Usuario'])],
            'status_user' => ['required', Rule::in(['Activo', 'Inactivo', 'Eliminado'])],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
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
            'persona_id.required' => 'Debe seleccionar una persona o crear una nueva.',
            'persona_id.exists' => 'La persona seleccionada no existe.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.size' => 'El DNI debe tener 8 caracteres.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'nombres.max' => 'Los nombres no pueden exceder 150 caracteres.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'apellidos.max' => 'Los apellidos no pueden exceder 150 caracteres.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in' => 'El sexo debe ser Masculino o Femenino.',
            'name.required' => 'El nombre de usuario es obligatorio.',
            'name.max' => 'El nombre de usuario no puede exceder 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.in' => 'El rol debe ser Administrador o Usuario.',
            'status_user.required' => 'El estado es obligatorio.',
            'status_user.in' => 'El estado debe ser Activo, Inactivo o Eliminado.',
            'profile_picture.image' => 'El archivo debe ser una imagen.',
            'profile_picture.mimes' => 'La imagen debe ser jpeg, png, jpg, gif o webp.',
            'profile_picture.max' => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}

<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRegisterRequest extends FormRequest
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
            'dni' => ['required', 'string', 'size:8', 'unique:personas,dni'],
            'nombres' => ['required', 'string', 'max:150'],
            'apellidos' => ['required', 'string', 'max:150'],
            'sexo' => ['required', Rule::in(['Masculino', 'Femenino'])],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
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
            'dni.required' => 'El DNI es obligatorio.',
            'dni.size' => 'El DNI debe tener 8 caracteres.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'nombres.required' => 'Los nombres son obligatorios.',
            'apellidos.required' => 'Los apellidos son obligatorios.',
            'sexo.required' => 'El sexo es obligatorio.',
            'sexo.in' => 'El sexo debe ser Masculino o Femenino.',
            'name.required' => 'El nombre de usuario es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'profile_picture.image' => 'El archivo debe ser una imagen.',
            'profile_picture.mimes' => 'La imagen debe ser jpeg, png, jpg o gif.',
            'profile_picture.max' => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}

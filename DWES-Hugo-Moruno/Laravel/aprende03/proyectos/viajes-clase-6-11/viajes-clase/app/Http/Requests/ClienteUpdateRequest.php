<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateRequest extends FormRequest
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
            'nif' => 'required|min:8|max:12',
            'nombre' => 'required|min:3|max:50',
            'apellido1' => 'required|max:20',
            'apellido2' => '',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'foto' => '',
            'observaciones' => '',
            'active' => '',
        ];
    }

    public function attributes()
    {
        return [
            'apellido1' => 'Apellido 1º',
        ];
    }
}

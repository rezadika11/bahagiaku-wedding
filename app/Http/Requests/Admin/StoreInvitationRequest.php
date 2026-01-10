<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvitationRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'theme_id' => 'required|exists:themes,id',
            'groom_name' => 'required|string|max:255',
            'bride_name' => 'required|string|max:255',
            'wedding_date' => 'required|date',
            'slug' => 'nullable|string|unique:invitations,slug',
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
            'client_id.required' => 'Please select a client.',
            'client_id.exists' => 'Selected client does not exist.',
            'theme_id.required' => 'Please select a theme.',
            'theme_id.exists' => 'Selected theme does not exist.',
            'groom_name.required' => 'Groom name is required.',
            'bride_name.required' => 'Bride name is required.',
            'wedding_date.required' => 'Wedding date is required.',
            'wedding_date.date' => 'Please provide a valid date.',
            'slug.unique' => 'This slug is already taken.',
        ];
    }
}

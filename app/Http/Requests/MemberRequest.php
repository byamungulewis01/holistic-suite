<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // change to false if you want to use Gate::authorize() in controller
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:5',
            'email' => 'nullable', 'email',
            'phone' => 'nullable|numeric|digits:10',
            'nid' => 'nullable|numeric|digits:16',
            'province' => 'required',
            'district' => 'required',
            'sector' => 'required',
            'cell' => 'required',
            'village' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'dateOfBirth' => 'required|date',
            'education' => 'required',
            'disability' => 'nullable',
            'training' => 'nullable',
            'professional' => 'nullable',
            'employer' => 'nullable',
            'field' => 'nullable|array',
            'insurance' => 'required',
            'saving' => 'nullable',
            'ministry' => 'required|array',
            'relation' => 'required',
            'status' => 'required',
        ];
    }
}

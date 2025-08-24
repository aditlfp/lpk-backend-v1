<?php

namespace App\Filament\Resources\LpkClassResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLpkClassRequest extends FormRequest
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
			'image' => 'required',
			'title' => 'required',
			'desc' => 'required|string',
			'waktu_pendidikan' => 'required',
			'bersertifikat' => 'required',
			'url' => 'required',
			'active' => 'required'
		];
    }
}

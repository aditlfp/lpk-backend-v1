<?php

namespace App\Filament\Resources\ActiveKandidatResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActiveKandidatRequest extends FormRequest
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
			'best_student_id' => 'required',
			'field_officiers_id' => 'required',
			'sensei_id' => 'required'
		];
    }
}

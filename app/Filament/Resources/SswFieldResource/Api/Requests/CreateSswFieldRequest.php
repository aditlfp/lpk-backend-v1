<?php

namespace App\Filament\Resources\SswFieldResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSswFieldRequest extends FormRequest
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
			'image_icon' => 'required',
			'title' => 'required',
			'subtitle_japan' => 'required',
			'desc' => 'required',
			'jumlah_dibutuhkan' => 'required'
		];
    }
}

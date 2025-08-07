<?php

namespace App\Filament\Resources\MainHeroResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMainHeroRequest extends FormRequest
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
			'c_image' => 'required',
			'main_logo' => 'required',
			'text_logo' => 'required',
			'title' => 'required',
			'desc' => 'required|string',
			'collab_logo' => 'required',
			'is_pinned' => 'required'
		];
    }
}

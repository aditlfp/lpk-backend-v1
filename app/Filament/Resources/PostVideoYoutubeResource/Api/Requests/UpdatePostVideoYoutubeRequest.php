<?php

namespace App\Filament\Resources\PostVideoYoutubeResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostVideoYoutubeRequest extends FormRequest
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
			'thumbnail' => 'required',
			'url_video' => 'required',
			'title' => 'required',
			'desc' => 'required|string',
			'location' => 'required|string',
			'category' => 'required',
			'tag' => 'required',
			'duration' => 'required'
		];
    }
}

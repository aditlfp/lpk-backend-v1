<?php

namespace App\Filament\Resources\CommentResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
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
			'image_foto' => 'required',
			'username' => 'required',
			'comment' => 'required|string',
			'location' => 'required',
			'rating' => 'required'
		];
    }
}

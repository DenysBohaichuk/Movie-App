<?php

namespace App\Http\Requests\Admin\Movies;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreMovieRequest extends FormRequest
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
            'status' => 'required|boolean',
            'title_ua' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'description_ua' => 'required',
            'description_en' => 'required',
            'poster' => 'required|image',
            'screenshots.*' => 'nullable|image',
            'trailer_id' => 'nullable|string|max:255',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'view_start_date' => 'nullable|date',
            'view_end_date' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'integer|exists:tags,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        session()->flash('flash_message', [
            'type' => 'error',
            'message' => implode("\n", $errors)
        ]);

        throw new ValidationException($validator);
    }
}

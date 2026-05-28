<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=> "required",
            "author"=> "required",
            "genre"=> "required",
            "published_year"=> "required",
            'pdf_file' => 'required|file|mimes:pdf|max:10000',
        ];
    }

    public function messages(): array
    {
        return [
            "title.required"=> "Le titre est requis",
            "author.required"=> "L'auteur est requis",
            "genre.required"=> "Le genre est requis",
            "published_year.required"=> "L'année de publication est requise",
            "pdf_file.required"=> "Le fichier est requis",
            "pdf_file.file"=> "Le fichier doit être un fichier",
            "pdf_file.mimes"=> "Le fichier doit être un fichier PDF",
            "pdf_file.max"=> "Le fichier doit être inférieur à 10MB",
        ];
    }
}

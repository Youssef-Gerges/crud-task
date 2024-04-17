<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'article_id' => 'required|exists:articles,id',
            'title' => 'required|max:255|min:1|unique:articles,title,' . $this->article_id,
            'images' => 'array|nullable',
            'images.*' => 'nullable|file|mimes:png,jpg,jpeg'
        ];
    }
}

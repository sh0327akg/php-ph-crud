<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'genre' => 'required|in:塩,醤油,味噌,とんこつ,その他',
            'satisfaction' => 'required|integer|min:1|max:5'
        ];
    }
}

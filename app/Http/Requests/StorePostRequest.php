<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->exists;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:4', 'max:512'],
            'description' => ['required', 'min:1', 'max:2048'],
            'price' => ['required', 'min:200', 'max:100_000_000'], // min price of 2 Euro max of 1 million Euro
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!$this->user();
    }

    public function getPrice()
    {
        return $this->price ? round($this->price * 100) : null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'premium' => 'bool',
            'title' => ['min:4', 'max:512'],
            'description' => ['min:1', 'max:2048'],
            'price' => ['numeric', 'min:2', 'max:150000', 'decimal:0,2'],
            'category_id' => ['exists:categories,id']
        ];
    }
}

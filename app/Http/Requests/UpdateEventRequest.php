<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date' => ['required', 'date'],
            'location' => ['required', 'string'],
            'NumberOfSeats' => ['required', 'integer'],
            'category_id' => ['required', 'exists:categories,id'],
            'event' => ['image', 'mimes:jpeg,png,jpg,gif'],
            'booking_status'=>['required'],
        ];
    }
}

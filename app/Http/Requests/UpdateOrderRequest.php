<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => 'required|exists:statuses,id'
        ];
    }

    public function messages()
    {
        return [
            'status_id.required' => 'وضعیت سفارش الزامیست',
            'status_id.exists' => 'وضعیت ارسال شده نا معتبر است'
        ];

    }
}

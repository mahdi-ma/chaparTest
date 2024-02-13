<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'receiver_phone' => 'required',
            'receiver_postal_code' => 'required',
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_phone' => 'required',
            'sender_postal_code' => 'required',
            'packages' => 'present|array'
        ];
    }

    public function messages()
    {
        return [
            'receiver_name.required' => 'نام گیرنده الزامیست',
            'receiver_address.required' => 'آدرس گیرنده الزامیست',
            'receiver_phone.required' => 'شماره تماس گیرنده الزامیست',
            'receiver_postal_code.required' => 'کد پستی گیرنده الزلمیست',
            'sender_name.required' => 'نام فرستنده الزامیست',
            'sender_address.required' => 'آدرس فرستنده الزامیست',
            'sender_phone.required' => 'شماره تماس فرستنده الزامیست',
            'sender_postal_code.required' => 'کد پستی فرستنده الزلمیست',
            'sender_postal_code.present' => 'حداقل یک بسته الزامیست',
        ];
    }

}

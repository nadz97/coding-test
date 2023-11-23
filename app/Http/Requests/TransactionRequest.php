<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'total_amount' => ['required', 'max:100'],
            'status' => ['required', 'in:SUCCESS,FAILED,PENDING'],

            'item_name' => ['required', 'string', 'max:100'],
            'item_quantity' => ['required', 'max:100'],
            'item_amount' => ['required', 'max:100'],

            'customer_name' => ['required', 'string', 'max:100'],
            'customer_email' => ['required', 'max:200'],
            'customer_phone' => ['required', 'max:100'],
        ];
    }
}

<?php

namespace App\Http\Requests\Wallet;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DepositRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.00000001',
            'hash' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'amount' => 'сумма транзакции',
            'hash' => 'хэш транзакции',
        ];
    }

    public function messages(): array
    {
        return [
            'string' => 'Поле «:attribute» должно быть строкой.',
            'required' => 'Поле «:attribute» обязательно для заполнения.',
            'numeric' => 'Поле «:attribute» должно быть в формате числа.',
            'min' => 'Поле «:attribute» не должно быть меньше :min.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Ошибка валидации',
            'errors' => $validator->errors(),
        ], 422));
    }

    public function getData(
        //
    ): array
    {
        return [
            'amount' => $this->input('amount'),
            'hash' => $this->input('hash'),
        ];
    }
}

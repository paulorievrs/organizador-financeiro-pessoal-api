<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'description' => 'string',
            'value' => 'numeric',
            'type_id' => 'exists:expense_types,id',
            'date' => 'date|date_format:Y-m-d',
            'deadline' => 'date|date_format:Y-m-d'
        ];
    }
}

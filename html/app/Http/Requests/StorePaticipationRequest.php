<?php

namespace App\Http\Requests;

use App\Models\{Participation};
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaticipationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 
     */
    protected function prepareForValidation ()
    {
        # code
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ticket' => 'required|image|mimes:jpeg,bmp,jpeg,png,jfif',
            'ticket_code' => [
                'required',
                function ($attribute, $value, $fail) {
                    $code_exists = Participation::whereTicketCode($value)
                                                    ->whereStatus(2)
                                                    ->first();

                    if ($code_exists) {
                        return $fail('Este ticket ya ha sido utilizado.');
                    }
                }
            ]
        ];
    }
}
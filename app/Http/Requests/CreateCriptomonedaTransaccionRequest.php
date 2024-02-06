<?php

namespace App\Http\Requests;

use App\Models\CriptomonedaTransaccion;
use Illuminate\Foundation\Http\FormRequest;

class CreateCriptomonedaTransaccionRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return CriptomonedaTransaccion::$rules;
    }

    public function messages()
    {
        return CriptomonedaTransaccion::$messages;
    }
}

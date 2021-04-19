<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Ultis\Response;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
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
        return [
            'id' => 'required|max:255',
            'userName' => 'required|max:120',
            'email' => 'required|max:120',
            'password' => 'required|max:120',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $dataRep = [
            'error' => $validator->errors()
        ];

        throw new HttpResponseException(Response::sendBadRequest($dataRep));
    }
}

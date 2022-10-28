<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckRequestAPI extends FormRequest
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
            'smsid' => 'required',
            'status' => 'required',
            'mt_count' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'smsid.required' => 'Ban phai truyen vao SMSID',
            'status.required' => 'Ban phai tra trang thai cho SMSID tren',
            'mt_count.required' => 'mt_count is required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {

        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(
            [
                'status' => 0,
                'desc' => 'Invalid input data. Please check again',
            ],
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}

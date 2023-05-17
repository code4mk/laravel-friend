<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator): void
    {
        //  Create a new ValidationException instance
        $exception = (new ValidationException($validator));

        // Prepare the response data.
        $data = [
            'type' => 'ValidationException',
            'code' => $exception->status,
            'message' => $exception->getMessage(),
            'errors' => $this->transformErrors($exception),
        ];

        // Throw a new HttpResponseException with a JSON response.
        throw new HttpResponseException(response()->json($data, $exception->status));
    }

    /**
     * Transform validation error message.
     *
     * @param  Illuminate\Validation\ValidationException  $exception
     * @return array
     */
    private function transformErrors(ValidationException $exception): array
    {
        $errors = [];

        foreach ($exception->errors() as $field => $message) {
            $errors[] = [
                'field' => $field,
                'message' => $message[0],
            ];
        }

        return $errors;
    }
}

<?php

namespace App\Http\Requests\Demo;

use App\Http\Requests\BaseFormRequest;

class DemoStoreRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'title.required' => 'A title is required',
        ];
    }
}

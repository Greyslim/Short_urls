<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\api\v1\ShortUrlRequest;

class MainUrlRequest extends ShortUrlRequest
{
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(redirect()->route('home')->with([
            'message'   => $validator->errors()->first(),
        ]));
    }
}

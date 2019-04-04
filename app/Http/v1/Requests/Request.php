<?php

namespace App\Http\v1\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
class Request extends FormRequest
{
    protected $version = 'v1';
    protected $from = null;
    protected $log = false;
    protected $type = 'FAILED';
    protected $code = null;
    protected $msg = null;
    protected function failedValidation(Validator $validator)
    {
        $key = $validator->getMessageBag()->first();
        if (!is_null($this->from)) {
            $key = "{$this->from}.$key";
        }
        $response = app("App\\Http\\{$this->version}\\Responses\\Response");
        $response->setInfo($this->type, $this->code, $this->msg);
        throw new ValidationException($validator, $response->failed($key));
    }
}
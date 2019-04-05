<?php
namespace App\Http\v1\Requests;

class UserLoginRequest extends Request
{
    protected $from;

    public function __construct()
    {
        $this->from = "USER_LOGIN";
        $this->code = config('responsecode.auth.login.failed');
        $this->msg = trans('responsecode.auth.login.failed');
    }
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [            
            'email' => 'required',            
            'password' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'email.*' => 'INVALID_EMAIL',
            'password.*' => 'INVALID_PASSWORD',
        ];
    }
}
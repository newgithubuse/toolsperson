<?php
namespace App\Http\v1\Requests;

class UserRegisteredRequest extends Request
{
    protected $from;

    public function __construct()
    {
        $this->from = "USER_REGISTERED";
        $this->code = config('responsecode.user.registered.failed');
        $this->msg = trans('responsecode.user.registered.failed');
    }
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required',
            'gender' => 'required|integer',
            'password' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.*' => 'INVALID_NAME',
            'email.*' => 'INVALID_EMAIL',
            'gender.*' => 'INVALID_GENDER',
            'password.*' => 'INVALID_PASSWORD',
            'phone.*' => 'INVALID_PHONE',
        ];
    }
}
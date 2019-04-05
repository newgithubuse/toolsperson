<?php
namespace App\Http\v1\Requests;

class UserSubmitRequest extends Request
{
    protected $from;

    public function __construct()
    {
        $this->from = "USER_SUBMIT";
        $this->code = config('responsecode.user.submit.failed');
        $this->msg = trans('responsecode.user.submit.failed');
    }
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [            
            'email' => 'required',
            'title' => 'required',
            'text' => 'required',
            'detail' => 'required',
            'img' => 'required',
            'createdatetime' => [
                'required',              
                'date_format:"Y-m-d H:i:s"',                
            ],
        ];
    }
    public function messages()
    {
        return [
            'email.*' => 'INVALID_EMAIL',
            'title.*' => 'INVALID_TITLE',
            'detail.*' => 'INVALID_DETAIL',
            'img.*' => 'INVALID_IMG',
            'createdatetime.*' => 'INVALID_CREATEDATETIME',
        ];
    }
}
<?php

namespace App\Http\v1\Controllers;

use Exception;
use App\Models\User;
use App\Models\UserPostEvent;
use App\Exceptions\UserException;
use App\Http\v1\Responses\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\v1\Services\UserService;
use App\Http\v1\Requests\UserLoginRequest;
use App\Http\v1\Requests\UserSubmitRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Http\v1\Requests\UserRegisteredRequest;

class UserController
{
    public function __construct(Response $response, UserService $userService)
    {        
		$this->response = $response;
		$this->userService = $userService;
    }


	public function registered(UserRegisteredRequest $request)
	{
		try{			
			$this->userService->checkRepeat($request);
			$this->response->setInfo('SUCCESS', config('responsecode.user.registered.success'), trans('responsecode.user.registered.success') );
			return $this->response->success();
		} catch(UserException $e) {
			$this->response->setInfo('FAILED', $e->getCode(), $e->getMessage());
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.registered.failed'), trans('responsecode.user.registered.failed') );
		}
		return $this->response->failed();
	}

	public function submitObject(UserSubmitRequest $request)
	{
		try {
			$user = User::where('email', $request->email)->first();	
			UserPostEvent::create([
				'user_id' => $user->id,
				'title' => $request->title,
				'text' => $request->text,
				'detail' => $request->detail,
				'img' => $request->img,				
				'createdatetime' => $request->createdatetime,
			]);			
			$this->response->setInfo('SUCCESS', config('responsecode.user.submit.success'), trans('responsecode.user.submit.success') );
			return $this->response->success($request->all());			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.submit.failed'), trans('responsecode.user.submit.failed') );
		}
		return $this->response->failed();
	}
	
	public function getPostEvent(Request $request)
	{
		try {
			$user = User::where('email', $request->email)->first();
			$result = UserPostEvent::where('user_id', $user->id)->get();	
			$this->response->setInfo('SUCCESS', config('responsecode.user.get.success'), trans('responsecode.user.get.success') );
			return $this->response->success($result);			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.get.failed'), trans('responsecode.user.get.failed') );
		}
		return $this->response->failed();
	}

	public function update(Request $request) 
	{
		try {			
			User::where('email', $request->oldemail)->firstOrFail()->update($request->only(['email',"name","phone"]));					
			$this->response->setInfo('SUCCESS', config('responsecode.user.update.success'), trans('responsecode.user.update.success') );
			return $this->response->success();			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.update.failed'), trans('responsecode.user.update.failed') );
		}
		return $this->response->failed();		
	}
}

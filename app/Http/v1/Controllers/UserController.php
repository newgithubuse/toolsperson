<?php

namespace App\Http\v1\Controllers;

use Exception;
use App\Models\User;
use App\Models\UserPostEvent;
use App\Models\RegistrationForm;
use App\Exceptions\UserException;
use App\Http\v1\Responses\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\v1\Services\UserService;
use App\Http\v1\Requests\UserLoginRequest;
use App\Http\v1\Requests\UserSubmitRequest;
use Symfony\Component\HttpFoundation\Request;
use App\Http\v1\Requests\UserRegisteredRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
			Log::info('$request => ' . print_r(json_encode($request->all()),true));			
			$user = User::where('email', $request->email)->firstOrFail();
			$userPostEvent = UserPostEvent::create([
				'user_id' => $user->id,
				'name' => $user->name,
				'title' => $request->title,
				'text' => $request->text,
				'detail' => $request->detail,
				'img' => $request->img,
				'footer' => $request->footer,		
				'createdatetime' => $request->createdatetime,
			]);			
			$this->response->setInfo('SUCCESS', config('responsecode.user.submit.success'), trans('responsecode.user.submit.success') );
			return $this->response->success($userPostEvent);			
		} catch(ModelNotFoundException $e){
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.submit.notexist'), trans('responsecode.user.submit.notexist'));
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.submit.failed'), trans('responsecode.user.submit.failed') );
		}
		return $this->response->failed();
	}
	
	public function getPostEvent(Request $request)
	{
		try {
			Log::info('$request => ' . print_r(json_encode($request->all()),true));
			$user = User::where('email', $request->email)->firstOrFail();
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
	
	public function getRegistrationUser(Request $request, $id){
		try {
			Log::info('$request => ' . print_r($request->all(),true));
			$user = User::where('email', $request->email)->firstOrFail();		
			$userpost = UserPostEvent::where('id', $id)->firstOrFail();
			if($user->id != $userpost->user_id) {
				throw new Exception;
			}
			$registrationsUser = RegistrationForm::where('event_id', $id)->get();			
			$userlist = collect([]);
			$registrationsUser->each(function($registrationUser) use (&$userlist){											 
					$user = User::where('id', $registrationUser->user_id)->first();
					$userlist->push([
						'id' => $user->id,
						'name' => $user->name
					]);					
			});
			$this->response->setInfo('SUCCESS', config('responsecode.user.getregistration.success'), trans('responsecode.user.getregistration.success') );
			return $this->response->success($userlist);			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.getregistration.failed'), trans('responsecode.user.getregistration.failed') );
		}
		return $this->response->failed();		
	}

	public function updateRegistrationStatus(Request $request, $id)
	{
		try {
			$registration = RegistrationForm::where('event_id', $id)->where('user_id', $request->id)->firstOrFail();
			$userpost = UserPostEvent::where('id', $id)->firstOrFail();
			$user = User::where('email', $request->email)->firstOrFail();
			if($user->id != $userpost->user_id) {
				throw new Exception;
			}			
			if($registration->status ==1 ){
				throw new UserException(trans('responsecode.user.updateregistration.exist'), config('responsecode.user.updateregistration.exist'));
			}
			$registration->update(['status' => 1]);
			$this->response->setInfo('SUCCESS', config('responsecode.user.updateregistration.success'), trans('responsecode.user.updateregistration.success') );
			return $this->response->success();			
		} catch(UserException $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', $e->getCode(), $e->getMessage());
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.user.updateregistration.failed'), trans('responsecode.user.updateregistration.failed') );
		}
		return $this->response->failed();		
	}
}

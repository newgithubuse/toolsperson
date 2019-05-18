<?php

namespace App\Http\v1\Controllers;

use Exception;
use App\Models\User;
use App\Models\ConnectUs;
use App\Models\UserPostEvent;
use App\Models\RegistrationForm;
use App\Exceptions\PublicException;
use App\Http\v1\Responses\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class PublicController
{
    public function __construct(Response $response)
    {        
		$this->response = $response;
    }

	public function getAllPostEvent()
	{
		try {
			$postEvent = UserPostEvent::all();			
			$this->response->setInfo('SUCCESS', config('responsecode.public.get.success'), trans('responsecode.public.get.success') );
			return $this->response->success($postEvent);			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.public.get.failed'), trans('responsecode.public.get.failed') );
		}
		return $this->response->failed();		
	}

	public function registrationEvent(Request $request, $id)
	{
		try {
			$user = User::where('email', $request->email)->firstOrFail();
			$haveRegistration = RegistrationForm::where('user_id', $user->id)->where('event_id', $id)->first();
			if($haveRegistration){
				throw new PublicException(trans('responsecode.public.registration.registered'), config('responsecode.public.registration.registered'));
			}
			RegistrationForm::create([
				'user_id'  => $user->id,
				'event_id' => $id,
			]);
			$this->response->setInfo('SUCCESS', config('responsecode.public.registration.success'), trans('responsecode.public.registration.success') );
			return $this->response->success();			
		} catch(PublicException $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', $e->getCode(), $e->getMessage());
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.public.registration.failed'), trans('responsecode.public.registration.failed') );
		}
		return $this->response->failed();		
	}

	public function connectus(Request $request)
	{
		try {
			ConnectUs::create($request->only('message'));
			$this->response->setInfo('SUCCESS', config('responsecode.public.connectus.success'), trans('responsecode.public.connectus.success') );
			return $this->response->success();			
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.public.connectus.failed'), trans('responsecode.public.connectus.failed') );
		}
		return $this->response->failed();		
	}
}

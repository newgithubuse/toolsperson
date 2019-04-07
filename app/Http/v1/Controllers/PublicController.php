<?php

namespace App\Http\v1\Controllers;

use Exception;
use App\Models\User;
use App\Models\UserPostEvent;
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


}

<?php

namespace App\Http\v1\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\v1\Responses\Response;
use App\Http\Controllers\Controller;
use App\Http\v1\Services\AuthService;
use App\Http\v1\Requests\UserLoginRequest;

class AuthController extends Controller
{


    public function __construct(AuthService $authService, Response $response)
    {
        $this->authService = $authService;
        $this->response = $response;
    }

  
    /**
     * Login user and create token
     *
     * @param  [string] token
     * @param  [object] user
     */
      
    public function login(UserLoginRequest $request)
	{
		try{			
            $result = $this->authService->fetchUser($request);
			$this->response->setInfo('SUCCESS', config('responsecode.auth.login.success'), trans('responsecode.auth.login.success') );
			return $this->response->success($result);
		} catch(Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.auth.login.failed'), trans('responsecode.auth.login.failed') );
		}
		return $this->response->failed();
	}

  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {   
        try{	            
            $accessToken = auth('v1')->user()->token();
            $refreshToken = DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);
            $accessToken->revoke();
			$this->response->setInfo('SUCCESS', config('responsecode.auth.logout.success'), trans('responsecode.auth.logout.success') );
			return $this->response->success();
		} catch (Exception $e) {
			Log::error('error :' . $e);
			$this->response->setInfo('FAILED', config('responsecode.auth.logout.failed'), trans('responsecode.auth.logout.failed') );
		}
		return $this->response->failed();
    }
}

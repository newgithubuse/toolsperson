<?php
namespace App\Http\v1\Services;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthService
{
    public function __construct(UserRepository $userRepository, Redis $redis)
    {
        $this->userRepository = $userRepository;
		$this->redis = $redis;
    }

    /**
     * 使用者登入
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function fetchUser($request)
    {    
		$user = User::where('email', $request->email)->first();
		if (!$user) {
			return response()->json(['message' => '帳號或密碼輸入錯誤!'], 422);
		} else if (! Hash::check($request->password, $user->password)) {
			return response()->json(['message' => '帳號或密碼輸入錯誤!'], 422);
		}
		
		$client = DB::table('oauth_clients')->where('password_client', true)->first();
		$data = [
			'grant_type' => 'password',
			'client_id' => $client->id,
			'client_secret' => $client->secret,
			'username' => $request->email,
			'password' => $request->password,
		];
		$request = Request::create('/oauth/token', 'POST', $data);
		$token = json_decode(app()->handle($request)->getContent());
		return ['token' => $token->access_token, 'user' => $user];        
    }


}
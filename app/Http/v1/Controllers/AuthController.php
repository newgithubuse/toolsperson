<?php

namespace App\Http\v1\Controllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected $http;

    public function __construct()
    {
        $this->http = new Client;
    }
        /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

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
        return response()->json(['token' => $token->access_token, 'user' => $user], 200);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $accessToken = auth('v1')->user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)->update(['revoked' => true]);
        $accessToken->revoke();
        return response()->json(['status' => 200]);
    }
  

    public function getOAuthToken($username, $password)
    {
        $response = $this->http->post(route('passport.token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '2',
                'client_secret' => 'pKuis21anxHp8HyAcvNivPKegRYhBQSejbBpkkCw',
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ],
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}

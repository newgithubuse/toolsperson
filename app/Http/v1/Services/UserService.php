<?php
namespace App\Http\v1\Services;
use Exception;
use App\Exceptions\UserException;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserService
{
    public function __construct(UserRepository $userRepository, Redis $redis)
    {
        $this->userRepository = $userRepository;
        $this->redis = $redis;
    }
    /**
     * 使用者註冊
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function checkRepeat($request)
    {    
        $user = $this->userRepository->findByField('email', $request->email)->first();   
        if ($user) {
            throw new UserException(trans('responsecode.user.registered.exist'), config('responsecode.user.registered.exist'));
        }
        $this->userRepository->create([
                'name' => $request->name,
                'email' =>  $request->email,
                'gender' => $request->gender,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
        ]);
    }

    /**
     * 使用者登入
     *
     * @param  mixed $request
     *
     * @return void
     */
    public function valUser($request)
    {    
        $user = $this->userRepository->findByField('email', $request->email)->first();
        if(! ($user || Hash::check($request->password, $user->passowrd)) ) {
            throw new Exception;
        }
        
    }


}
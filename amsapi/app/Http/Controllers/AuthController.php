<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
// use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Psr\Http\Message\ServerRequestInterface;
use \Laravel\Passport\Http\Controllers\AccessTokenController;
use DB;
use App\Contact;
use Activation;

class AuthController extends AccessTokenController
{
    public function auth(ServerRequestInterface $request)
    {       
            $username = $request->getParsedBody()['username'];
            $password = $request->getParsedBody()['password'];
            $user = User::where('email',$username)->orWhere('phone',$username)->first();
            if($user){
               if(sizeof(Activation::where('user_id',$user->id)->where('completed',1)->get()) > 0){

               }
               else{
                    return response()->json(['error'=>'আপনার ফোন / ইমেল ভেরিফাইড না !!'],400);
               }

               if($user->type == 9){
                    if(!$user->permissions == 1){
                        return response()->json(['error'=>'এখনো লগইন এর অনুমোদন নেই'],400);
                    }
               }

               if(Hash::check($password,$user->password)){
                    $tokenResult = $user->createToken('Password Access Token');
                    $token = $tokenResult->token;
                    $token->save();
                    return response()->json([
                        'access_token' =>  $tokenResult->accessToken,
                        'expires_at'   =>  $tokenResult->token->expires_at,
                        'token_type'   => 'Bearer',
                        'user'         =>  $user,
                        // 'userinfo' =>$user->userinfo,
                        //'permission'   => json_decode($role[0]->permissions2)
                    ]);
                }
                else{
                    return response()->json(['error'=>'সঠিক তথ্য দিন'],400);
                } 
            }
            else{
                return response()->json(['error'=>'সঠিক তথ্য দিন'],400);
            }
            return $username = $request->getParsedBody()['password'];
            // $user = User::where('email',$username)->orWhere('phone',$username)->first();
            // if()    
            $username = $request->getParsedBody()['username'];
            // return User::where('email',$username)->orWhere('phone',$username)->first();
            $tokenResponse = parent::issueToken($request);
            $token = $tokenResponse->getContent();

            // $tokenInfo will contain the usual Laravel Passort token response.
            $tokenInfo = json_decode($token, true);

            // Then we just add the user to the response before returning it.
            // $username = $request->getParsedBody()['username'];
            $user = User::where('email',$username)->orWhere('phone',$username)->first();
            $tokenInfo = collect($tokenInfo);
            $tokenInfo->put('user', $user);

            return $tokenInfo;
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        return User::create([
        	'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    public function local()
    {
        // $role_id = DB::table('role_users')->where('user_id',auth()->user()->id)->first()->role_id;
        $user = User::find(auth()->user()->id);
        $user->role_id = $user->type;
        $user->save();
        return response()->json(['user' => $user]);
    }

    public function oauth()
    {
        return response()->json(auth()->user());
    }
}

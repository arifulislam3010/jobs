<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Reminders\EloquentReminder;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException; 
use Sentinel;
use Activation;
use App\Contact;
class RegistrationController extends Controller
{

    public function permission(){
        return "hello";
    }
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function mobileLogin(Request $request){
        $data = $request->all();
        if(filter_var($data['phone_email'], FILTER_VALIDATE_EMAIL)) {
            $type = 1;
            $data['email'] = $data['phone_email'];
        }else{
            $type=2;
            $data['phone'] = $data['phone_email'];
            
        } 
        if($type==1){
            $userfind = User::where('email',$data['email'])->first();
        }else{
            $userfind = User::Where('phone',$data['phone'])->first();
        }
        // return $data['phone'];
        

        if($userfind){
            // $user = Sentinel::findById(1);

            // Sentinel::login($user);
            $tokenResult = $userfind->createToken('Password Access Token');
            $token = $tokenResult->token;
            $token->save();
            // $role_user = DB::table('role_users')->where('user_id',$user->id)->get();
            // $role = DB::table('roles')->where('id',$role_user[0]->role_id)->get();
            return response()->json([
                'access_token' => $tokenResult->accessToken,
                'expires_at'   =>  $tokenResult->token->expires_at,
                'token_type'   => 'Bearer',
                'user'      => $userfind,
                'userinfo' =>$userfind->userinfo,
                //'permission'   => json_decode($role[0]->permissions2)
            ]);
        }
      

        

        // try{
            // DB::beginTransaction();
                if($data['applicant']==1){
                    $role_id = 6;
                }

                else if($data['agency']){
                    $role_id = 3;
                }
                if($type==1){
                    $credentials = [
                        'type'     => $role_id,
                        'name'     => 'Name',
                        'email'    => $data['email'],
                        'password' => '$2y$10$/yJOBCVl8SCwzZU30N2E/ePAYxT3lHo9FzkE5Xq03bYW.lUoEMX4e',
                        // 'phone'    => $request['phone'],
                    ];
                }else{
                    $credentials = [
                        'type'     => $role_id,
                        'name'     => 'Example Name',
                        // 'email'    => $request['phone'],
                        'password' => '$2y$10$/yJOBCVl8SCwzZU30N2E/ePAYxT3lHo9FzkE5Xq03bYW.lUoEMX4e',
                        'phone'    => $data['phone'],
                    ];
                }
                // return $credentials;
                

                // $user = Sentinel::register($credentials);
                $user1 = User::create($credentials);
                $user = Sentinel::findById($user1->id);
                $activation = Activation::create($user);
                $role = Sentinel::findRoleById($role_id);
                $role->users()->attach($user);
                Activation::completed($user);
                $contact = new Contact;
                $contact ->user_id = $user->id;
                $contact->save();
                
                if($user){
                    $tokenResult = $user1->createToken('Password Access Token');
                    $token = $tokenResult->token;
                    $token->save();
                    // $role_user = DB::table('role_users')->where('user_id',$user->id)->get();
                    // $role = DB::table('roles')->where('id',$role_user[0]->role_id)->get();
                    return response()->json([
                        'access_token' => $tokenResult->accessToken,
                        'expires_at'   =>  $tokenResult->token->expires_at,
                        'token_type'   => 'Bearer',
                        'user'      => $user,
                        'userinfo' =>$user->userinfo,
                        //'permission'   => json_decode($role[0]->permissions2)
                    ]);
                }
                // if($request->input('applicant')){
                //     $country_data = [];
                //     $job_data = [];
                //     $user_id = $user->id;
                //     foreach ($request->country as $key => $value) {
                //         $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                //         array_push($country_data,$temp);
                //     }
                //     foreach ($request->job as $key => $value) {
                //         $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                //         array_push($job_data,$temp);
                //     }
                //     CountryApplicant::where('user_id',$user_id)->delete();
                //     CountryApplicant::insert($country_data);

                //     DesiredJobApplicant::where('user_id',$user_id)->delete();
                //     DesiredJobApplicant::insert($job_data);
                    
                //     $contact ->progress = 30;
                //     $contact->personal = json_encode($request->only(['job','country']));

                //     $contact ->address2 = json_encode($request->input('address2'));
                //     $contact ->address3 = json_encode($request->input('address3'));
                //     $contact ->same_address = $request->input('same_address');
                //     $contact->update();

                //     $permanent_address = [
                //         'user_id' => $user_id,
                //         'div_id' => $request->address2['division']['id'],
                //         'dis_id' => $request->address2['district']['id'],
                //         'subdis_id' => $request->address2['subdistrict']['id'],
                //         'union_id' => $request->address2['union']['id'],
                //         'village' => $request->address2['village'],
                //         'post_office' => $request->address2['postoffice'],
                //         'road_no' => $request->address2['street'],
                //         'phone' => $request->address2['phone'],
                //         'type' => 1,
                //     ];

                //     $present_address = [
                //         'user_id' => $user_id,
                //         'div_id' => $request->address3['division']['id'],
                //         'dis_id' => $request->address3['district']['id'],
                //         'subdis_id' => $request->address3['subdistrict']['id'],
                //         'union_id' => $request->address3['union']['id'],
                //         'village' => $request->address3['village'],
                //         'post_office' => $request->address3['postoffice'],
                //         'road_no' => $request->address3['street'],
                //         'phone' => $request->address3['phone'],
                //         'type' => 2,
                //     ];

                //     Address::where('user_id',$user_id)->delete();
                //     Address::insert($permanent_address);
                //     Address::insert($present_address);
                //     $contact->update();
                // }

                // if($request->input('agency')){
                //     $country_data = [];
                //     $job_data = [];
                //     $user_id = $user->id;
                //     foreach ($request->country as $key => $value) {
                //         $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                //         array_push($country_data,$temp);
                //     }
                //     foreach ($request->job as $key => $value) {
                //         $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                //         array_push($job_data,$temp);
                //     }
                //     CountryAgent::where('user_id',$user_id)->delete();
                //     CountryAgent::insert($country_data);

                //     DesireJobAgent::where('user_id',$user_id)->delete();
                //     DesireJobAgent::insert($job_data);

                //     $contact->personal = json_encode($request->only(['job','country']));
                //     $contact->website  = $request->input('website');
                //     $contact->registration_number = $request->input('registration_number');
                //     $contact->contact_number = $request->input('phone2');
                //     $contact->address = json_encode($request->input('address'));
                //     $contact->update();

                //     $slug = str_replace(' ','-',$request['name']);
                //     $slug = strtolower($slug);
                    
                //     if(User::where('slug',$slug)->first())
                //     {
                //        $user->slug = $slug.'-'.str_random(5);
                //        $user->save();
                //     }
                //     else{
                //        $user->slug = $slug; 
                //        $user->save();
                //     }
                // }
                

                // if($type == 2){
                //     $activation_id = Activation::where('code',$activation->code)->first()->id;
                //     $activation = Activation::find($activation_id); 
                //     $activation->code = rand(100000,999999);
                //     $activation->update();
                //     $text = 'Your immigration.org.bd activation code is '.$activation->code;
                //     $this->sendSms($user->phone,$text);
                // }
                // else if($type == 1){
                //     // $this->sendConfirmationEmail($user,$activation->code);
                //     // return response()->json(['verify'=>'অনুগ্রহপূর্বক আপনার ইমেইল ভেরিফাই করুন'],201);
                // }
                
            DB::commit();

                if($type == 2){
                    return response()->json(['phone'=>$user->phone],201);
                }
                else if($type == 1){
                    return response()->json(['verify'=>'অনুগ্রহপূর্বক আপনার ইমেইল ভেরিফাই করুন'],201);
                }

        // }

        // catch(\Exception $e){
        //     DB::rollBack();
        //     return response()->json(['errors'=>['status' => false , 'message' =>  $e]] , 401);
        // } 
    }   
}

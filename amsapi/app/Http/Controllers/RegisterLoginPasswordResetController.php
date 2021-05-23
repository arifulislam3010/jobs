<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Address;
use App\User;
use App\Contact;
use App\CountryApplicant;
use App\DesiredJobApplicant;
use App\CountryAgent;
use App\DesireJobAgent;
use Sentinel;
use Activation;
use Mail;
use Reminder;
use Auth;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException; 
use DB;
use Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Passport;
use Cartalyst\Sentinel\Activations\EloquentActivation;
use Cartalyst\Sentinel\Reminders\EloquentReminder;

class RegisterLoginPasswordResetController extends Controller
{
    public function test(){
        return redirect('http://localhost:3000/login');
        $url = "http://66.45.237.70/api.php";
        $number="8801784661703";
        $text="Hello Bangladesh";
        $data= array(
        'username'=>"01730091309",
        'password'=>"8RN9ZD24",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];

        return "ok";
    }

    protected function sendSms($number,$text){
        $url = "http://66.45.237.70/api.php";
        // $number="8801784661703";
        // $text="Hello Bangladesh";
        $data= array(
        'username'=>"01730091309",
        'password'=>"8RN9ZD24",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];

        return true;
    }

    public function register(Request $request)
    {
        
    	try{
    		$request->validate([
	            'name' => ['required', 'string', 'max:255'],
	            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
	            'password' => ['required', 'string', 'min:6'],
	        ]);

	    	$user = Sentinel::register($request->all());

            $role = Sentinel::findRoleById($request->role_id);
            $role->users()->attach($user);

            $contact = new Contact;
            $contact -> user_id = $user->id;
            // $contact -> district_id = 1;
            // $contact -> subdistrict_id = 1;
            $contact -> created_by = $user->id;
            $contact -> updated_by = $user->id;
            $contact->save();
	        // $activation = Activation::create($user);
	        // $this->sendConfirmationEmail($user,$activation->code);
	        return response()->json(['success'=>'Please Verify Your Email'],200);
    	}
    	catch (ValidationException $e) {
         	return response()->json(['error'=>"The Email is Already Used"],400);
     	}
    	catch (QueryException $e) {
         	return response()->json(['error'=>'The Email is Already Used'],400);
     	}
    	
    }

    private function sendConfirmationEmail($user,$code){
        Mail::send('Email.activation',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Activate your account");
        });
    }

    public function activateAccount($email,$activationCode)
    {

        $user = User::whereEmail($email)->first();
        $sentineluser = Sentinel::findById($user->id);
        if(Activation::complete($sentineluser,$activationCode)){
            return redirect('http://immigration.org.bd/login');
        }else
        {
            return "Woops! Something went wrong";
        }
    }

    public function activateAccountByPhone($phone,$activationCode)
    {

        $user = User::where('phone',$phone)->first();
        $sentineluser = Sentinel::findById($user->id);
        if(Activation::complete($sentineluser,$activationCode)){
            return response()->json(['success'=>'ok'],200);
        }else
        {
            return response()->json(['error'=>'faild'],400);
        }
    }

    public function login(Request $request)
    {
        // return $request->all();
        try{
            if(Sentinel::authenticate($request->all())){
                $user = User::whereEmail($request->email)->first();
                $tokenResult = $user->createToken('Password Access Token');
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
            else{
                return response()->json(['error'=>'Credential Not Match'],400);
            }
        }
        catch(ThrottlingException $e){
            $delay = $e->getDelay();
            return response()->json(['error'=>"You Are Suspend for $delay Second"],400);
        }
        catch(NotActivatedException $e){
            return response()->json(['error'=>'Your Account Is Not Activated'],400);
        }
    }

    public function forgotPassword(Request $request)
    {
        try{
            $phone = '';
            $email = '';
            $user = '';
            if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
                $email = $request->input('email');
                $user = User::where('email',$request->email)->first();
                if($user){
                    $sentineluser = Sentinel::findById($user->id);
                    $reminder = Reminder::exists($sentineluser) ? : Reminder::create($sentineluser);
                    $this->sendResetEmail($user,$reminder->code);
                    return response()->json(['success'=>'আমরা আপনার ইমেইলে একটি রিসেট লিঙ্ক প্রেরণ করেছি','phone'=>'email'],200);
                }
                else{
                    return response()->json(['error'=>'কোন ইউজার পাওয়া যায় নি !!'],400);
                }
            }
            else{
               $phone = $request->input('email');
               $user = User::where('phone',$request->email)->first();
               if($user){
                    $sentineluser = Sentinel::findById($user->id);
                    $reminder = Reminder::exists($sentineluser) ? : 1;
                    if($reminder == 1){
                        $reminder = new EloquentReminder;
                        $reminder->code = rand(100000,999999);
                        $reminder->completed = false;
                        $reminder->user_id = $user->id;
                        $reminder->save(); 
                    }

                    $text = 'Your immigration.org.bd password reset code is '.$reminder->code;
                    $this->sendSms($user->phone,$text);
                    return response()->json(['success'=>'Please Reset Your Password','phone'=>'phone'],200);
                }
                else{
                    return response()->json(['error'=>'কোন ইউজার পাওয়া যায় নি !!'],400);
                }
            }
            
        }
        catch (ValidationException $e) {
            return response()->json(['error'=>"The email/ phone is not valid"],400);
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'The email/phone is not exist'],400);
        }
    }

    private function sendResetEmail($user,$code){
        Mail::send('Email.forgot_password',[
            'user' => $user,
            'code' => $code,
        ],function($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello  $user->name, Reset your account");
        });
    }

    public function postResetPassword(Request $request)
    {
        $user = '';
        // if(($request->input('phone')){
        //     return "ok";
        //     // $user = User::where('phone',$request->phone)->first();
        // }

        // if(($request->input('email')){
        //     // $user = User::where('email',$request->email)->first();
        //     return "ok";
        // }

        if($request->input('email')){
            $user = User::where('email',$request->email)->first();
        }

        if($request->input('phone')){
            $user = User::where('phone',$request->phone)->first();
        }
        
        $sentineluser = Sentinel::findById($user->id);
        $reminder = Reminder::exists($sentineluser);

        if($reminder = Reminder::exists($sentineluser)){
            if($request->code == $reminder->code){
                Reminder::complete($sentineluser,$request->code,$request->password);
                return response()->json(['success'=>'Password Change Successfully'],200);
            }
            else
            {
                return response()->json(['error'=>'দুঃখিত! যাচাইকরণ কোডটি ভুল'],400);
            }
        }
        else
        {
            return response()->json(['error'=>'Sorry! The request is not valid'],400);
        }
    }

    // public function postResetPassword(Request $request,$email,$code)
    // {
    //     $user = User::whereEmail($email)->first();
    //     $sentineluser = Sentinel::findById($user->id);

    //     if($reminder = Reminder::exists($sentineluser)){
    //         if($code == $reminder->code){
    //             Reminder::complete($sentineluser,$code,$request->password);
    //             return response()->json(['success'=>'Password Change Successfully'],200);
    //         }
    //         else
    //         {
    //             return response()->json(['error'=>'Sorry! The request is not valid'],400);
    //         }
    //     }
    //     else
    //     {
    //         return response()->json(['error'=>'Sorry! The request is not valid'],400);
    //     }
    // }

    public function validation(Request $request){
        if (filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)) {
            if(User::where('email',$request->input('email'))->first()){
                return response()->json(['error'=>"The email is already used"],400);
            }
            else{
                return response()->json(['success'=>'ok'],200);
            }
        }
        else{
           if(is_numeric($request->input('email'))){
               if(User::where('phone',$request->input('email'))->first()){
                    return response()->json(['error'=>"The phone is already used"],400);
                }
                else{
                    return response()->json(['success okkk'=>'ok'],200);
                }
            }else{
                return response()->json(['error'=>"Invalid email or phone"],400);
            }
        } 
    }

    public function applicantAgency(Request $request){
        if(filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $type = 1;
        }else{
            $type=2;
            $request['phone'] = $request->email;
            $request['email'] = null;
        } 

        if($request->input('applicant')){
            if($type == 1){
                $rules = array(
                  'name'              => 'required',
                  'email'             => 'required|email|unique:users',
                  'password'          => 'required|min:8',
                  'confirm_password'  => 'required|same:password',
                );
                $messsages = array(
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
                   'email'=>'সঠিক ইমেইল দিন',
                   'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
                   'unique' => 'এই ইমেইল / ফোন অলরেডি রেজিস্টার করা  আছে',
                );
            }
            else{
                $rules = array(
                    'name'              => 'required',
                    'phone'             => 'required|digits:11|unique:users',
                    'password'          => 'required|min:8',
                    'confirm_password'  => 'required|same:password',
                );
                $messsages = array(
                   'digits'=>'11 ডিজিট হতে হবে',
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
                   'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
                   'unique' => 'এই ইমেইল / ফোন অলরেডি রেজিস্টার করা  আছে',
                );
            }
        }
        
        if($request->input('agency')){
            if($type == 1){
                $rules = array(
                  'name'                => 'required',
                  'email'               => 'required|email|unique:users',
                  'registration_number' => 'required|unique:contacts',
                  'password'            => 'required|min:8',
                  'confirm_password'    => 'required|same:password',
                );
                $messsages = array(
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
                   'email'=>'সঠিক ইমেইল দিন',
                   'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
                   'unique' => 'এই তথ্য অলরেডি রেজিস্টার করা  আছে',
                );
            }
            else{
                $rules = array(
                    'name'                => 'required',
                    'phone'               => 'required|digits:11|unique:users',
                    'registration_number' => 'required|unique:contacts',
                    'password'            => 'required|min:8',
                    'confirm_password'    => 'required|same:password',
                );
                $messsages = array(
                   'digits'=>'11 ডিজিট হতে হবে',
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
                   'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
                   'unique' => 'এই তথ্য অলরেডি রেজিস্টার করা  আছে',
                );
            }
        }

        $validator = Validator::make($request->all(),$rules,$messsages);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        try{
            DB::beginTransaction();
                $data = $request->all();
                if($request->input('applicant')){
                    $role_id = 6;
                }

                else if($request->input('agency')){
                    $role_id = 3;
                }

                $credentials = [
                    'type'     => $role_id,
                    'name'     => $request['name'],
                    'email'    => $request['email'],
                    'password' => $request['password'],
                    'phone'    => $request['phone'],
                ];

                $user = Sentinel::register($credentials);
                $activation = Activation::create($user);
                $role = Sentinel::findRoleById($role_id);
                $role->users()->attach($user);

                $contact = new Contact;
                $contact ->user_id = $user->id;
                $contact->save();

                if($request->input('applicant')){
                    $country_data = [];
                    $job_data = [];
                    $user_id = $user->id;
                    foreach ($request->country as $key => $value) {
                        $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                        array_push($country_data,$temp);
                    }
                    foreach ($request->job as $key => $value) {
                        $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                        array_push($job_data,$temp);
                    }
                    CountryApplicant::where('user_id',$user_id)->delete();
                    CountryApplicant::insert($country_data);

                    DesiredJobApplicant::where('user_id',$user_id)->delete();
                    DesiredJobApplicant::insert($job_data);
                    
                    $contact ->progress = 30;
                    $contact->personal = json_encode($request->only(['job','country']));

                    $contact ->address2 = json_encode($request->input('address2'));
                    $contact ->address3 = json_encode($request->input('address3'));
                    $contact ->same_address = $request->input('same_address');
                    $contact->update();

                    $permanent_address = [
                        'user_id' => $user_id,
                        'div_id' => $request->address2['division']['id'],
                        'dis_id' => $request->address2['district']['id'],
                        'subdis_id' => $request->address2['subdistrict']['id'],
                        'union_id' => $request->address2['union']['id'],
                        'village' => $request->address2['village'],
                        'post_office' => $request->address2['postoffice'],
                        'road_no' => $request->address2['street'],
                        'phone' => $request->address2['phone'],
                        'type' => 1,
                    ];

                    $present_address = [
                        'user_id' => $user_id,
                        'div_id' => $request->address3['division']['id'],
                        'dis_id' => $request->address3['district']['id'],
                        'subdis_id' => $request->address3['subdistrict']['id'],
                        'union_id' => $request->address3['union']['id'],
                        'village' => $request->address3['village'],
                        'post_office' => $request->address3['postoffice'],
                        'road_no' => $request->address3['street'],
                        'phone' => $request->address3['phone'],
                        'type' => 2,
                    ];

                    Address::where('user_id',$user_id)->delete();
                    Address::insert($permanent_address);
                    Address::insert($present_address);
                    $contact->update();
                }

                if($request->input('agency')){
                    $country_data = [];
                    $job_data = [];
                    $user_id = $user->id;
                    foreach ($request->country as $key => $value) {
                        $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                        array_push($country_data,$temp);
                    }
                    foreach ($request->job as $key => $value) {
                        $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                        array_push($job_data,$temp);
                    }
                    CountryAgent::where('user_id',$user_id)->delete();
                    CountryAgent::insert($country_data);

                    DesireJobAgent::where('user_id',$user_id)->delete();
                    DesireJobAgent::insert($job_data);

                    $contact->personal = json_encode($request->only(['job','country']));
                    $contact->website  = $request->input('website');
                    $contact->registration_number = $request->input('registration_number');
                    $contact->contact_number = $request->input('phone2');
                    $contact->address = json_encode($request->input('address'));
                    $contact->update();

                    $slug = str_replace(' ','-',$request['name']);
                    $slug = strtolower($slug);
                    
                    if(User::where('slug',$slug)->first())
                    {
                       $user->slug = $slug.'-'.str_random(5);
                       $user->save();
                    }
                    else{
                       $user->slug = $slug; 
                       $user->save();
                    }
                }
                

                if($type == 2){
                    $activation_id = Activation::where('code',$activation->code)->first()->id;
                    $activation = Activation::find($activation_id); 
                    $activation->code = rand(100000,999999);
                    $activation->update();
                    $text = 'Your immigration.org.bd activation code is '.$activation->code;
                    $this->sendSms($user->phone,$text);
                }
                else if($type == 1){
                    $this->sendConfirmationEmail($user,$activation->code);
                    // return response()->json(['verify'=>'অনুগ্রহপূর্বক আপনার ইমেইল ভেরিফাই করুন'],201);
                }
                
            DB::commit();

                if($type == 2){
                    return response()->json(['phone'=>$user->phone],201);
                }
                else if($type == 1){
                    return response()->json(['verify'=>'অনুগ্রহপূর্বক আপনার ইমেইল ভেরিফাই করুন'],201);
                }

        }

        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' =>  $e]] , 401);
        } 
           
    }

    public function admin(Request $request){
        if($request->input('phone')){
            $rules = array(
              'name'              => 'required',
              'email'             => 'required|email|unique:users',
              'phone'             => 'digits:11|unique:users',
              'password'          => 'required|min:8',
              'confirm_password'  => 'required|same:password',
            );
            $messsages = array(
               'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
               'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
               'email'=>'সঠিক ইমেইল দিন',
               'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
               'unique' => 'অলরেডি রেজিস্টার করা  আছে',
               'digits'=>'11 ডিজিট হতে হবে',
            );
        }
        else{
            $rules = array(
              'name'              => 'required',
              'email'             => 'required|email|unique:users',
              'password'          => 'required|min:8',
              'confirm_password'  => 'required|same:password',
            );
            $messsages = array(
               'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
               'min'=>'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
               'email'=>'সঠিক ইমেইল দিন',
               'same' => 'পাসওয়ার্ড দুটি ভিন্ন',
               'unique' => 'এই ইমেইল অলরেডি রেজিস্টার করা  আছে'
            );
        }
        

        $validator = Validator::make($request->all(),$rules,$messsages);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // return $request->all();
        try{
            DB::beginTransaction();
                $data = $request->all();
                $role_id = 9;
                $credentials = [
                    'type'     => $role_id,
                    'name'     => $request['name'],
                    'email'    => $request['email'],
                    'password' => $request['password'],
                    'phone'    => $request['phone'],
                ];

                $user = Sentinel::register($credentials);
                $activation = Activation::create($user);
                $role = Sentinel::findRoleById($role_id);
                $role->users()->attach($user);


                $contact = new Contact;
                $contact->user_id = $user->id;
                
                $contact->personal       = json_encode($request->input('designation'));
                $contact->designation_id = $request->input('designation_id');
                $contact->address2       = json_encode($request->only('division', 'district', 'subdistrict'));
                $contact->district_id    = $request->input('district_id');
                $contact->subdistrict_id = $request->input('subdistrict_id');
                $contact->division_id    = $request->input('division_id');
                
                if($request->not_edit_image == 11){
                    $exploded = explode(',', $request->image);
                    $decoded = base64_decode($exploded[1]);
                    if(str_contains($exploded[0], 'jpeg'))
                        $extension = 'jpg';
                    else
                        $extension = 'png';

                    $fileName = str_random().'.'.$extension;
                    $path = public_path().'/images/'.$fileName;
                    file_put_contents($path, $decoded);
                    $contact -> image = url('/').'/images/'.$fileName;
                }
                else{
                    $contact -> image = $request->image;
                }
                
                $contact->save();
                $this->sendConfirmationEmail($user,$activation->code);
                
            DB::commit();

            return response()->json(['verify'=>'অনুগ্রহপূর্বক আপনার ইমেইল ভেরিফাই করুন'],201);

        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' =>  $e]] , 401);
        } 
    }

}

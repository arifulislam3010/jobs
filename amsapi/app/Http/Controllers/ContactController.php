<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use App\Address;
use App\Nominee;
use App\Education;
use App\LanguageApllicant;
use App\Experience;
use App\Training;
use App\CountryAgent;
use App\DesireJobAgent;
use App\DesiredJob;
use App\Gallery;
use App\User;
use App\RoleUser;
use Sentinel;
use DateTime;
use Activation;

use Illuminate\Support\Facades\Hash;
use Validator;
use Cartalyst\Sentinel\Activations\EloquentActivation;

use App\Http\Resources\Contact as ContactResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserBasic as UserBasicResource;
use App\Http\Resources\GalleryResource as GalleryResources;
use App\CountryApplicant;
use App\DesiredJobApplicant;
use Auth;
use DB;
class ContactController extends Controller
{
    public function passwordChange(Request $request){
        $rules = array(
          // 'old_password'      => 'required',
          'new_password'      => 'required|min:8',
          'confirm_password'  => 'required|same:new_password',
        );
        $messsages = array(
           'required' => 'এই ঘরটি পূরণ করা আবশ্যক',
           'min'      => 'কমপক্ষে :৮ অক্ষর দীর্ঘ হতে হবে',
           'same'     => 'পাসওয়ার্ড দুটি ভিন্ন',
        );

        $validator = Validator::make($request->all(),$rules,$messsages);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);
        
        if (Hash::check($request->old_password, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->new_password)
           ])->save();
           return response()->json(['ok' => 'ok'], 200);
        }
        else{
            return response()->json(['errors' => array('old_password'=>'সঠিক পাসওয়ার্ড দিন')], 400);
        }
    }
    public function user(){
        $user = User::find(Auth::user()->id);
        return new UserResource($user);
    }
    public function details($id){
        $user = User::find($id);
        return new UserResource($user);
    }
    public function index(Request $request){
        $user = Auth::user();
        $data = $request->all();

        if($user->type == 1){
            $division_id           = ($data['division_id'])?$data['division_id']:null;
            $district_id           = ($data['district_id'])?$data['district_id']:null;
            $upozila_id            = ($data['upozila_id'])?$data['upozila_id']:null;
            $search                = ($data['search'])?$data['search']:null;
            $type                  = ($data['type'])?$data['type']:null;
            $migrate                  = ($data['migrate'])?$data['migrate']:null;
            $limit                  = ($data['limit'])?$data['limit']:null;
            $users = User::join('contacts','contacts.user_id','=','users.id')->join('role_users','role_users.user_id','=','users.id')
            ->when($division_id, function($q) use($division_id){return $q->where('contacts.division_id' , $division_id);})
            ->when($district_id, function($q) use($district_id){return $q->where('contacts.district_id' , $district_id);})
            ->when($upozila_id, function($q) use($upozila_id){return $q->where('contacts.subdistrict_id' , $upozila_id);})
            ->when($type, function($q) use($type){return $q->where('role_users.role_id' , $type);})
            ->when($migrate, function($q) use($migrate){return $q->where('contacts.migration_status',$migrate);})
            ->when($search, function($q) use($search){return $q->where('users.name','like',"%$search%");})
            ->select('users.*')
            ->paginate($limit);
            return UserBasicResource::collection($users);
        }
        elseif($user->type == 9){
            $contact = Contact::where('user_id',$user->id)->get()->first();
            $district_id = '';
            $subdistrict_id = '';
            $division_id = '';

            if($contact->designation_id == 1){
                $district_id = $contact->district_id;
            }
            elseif($contact->designation_id == 2){
                $subdistrict_id = $contact->subdistrict_id;
            }
            elseif($contact->designation_id == 3){
                $division_id = $contact->division_id;
            }

            $search                = ($data['search'])?$data['search']:null;
            $type                  = ($data['type'])?$data['type']:null;
            $limit                  = ($data['limit'])?$data['limit']:null;
            $users = User::join('contacts','contacts.user_id','=','users.id')->join('role_users','role_users.user_id','=','users.id')
            ->when($division_id, function($q) use($division_id){return $q->where('contacts.division_id' , $division_id);})
            ->when($district_id, function($q) use($district_id){return $q->where('contacts.district_id' , $district_id);})
            ->when($subdistrict_id, function($q) use($subdistrict_id){return $q->where('contacts.subdistrict_id' , $subdistrict_id);})
            ->when($type, function($q) use($type){return $q->where('role_users.role_id' , $type);})
            ->when($search, function($q) use($search){return $q->where('users.name','like',"%$search%");})
            ->select('users.*')
            ->paginate($limit);
            return UserBasicResource::collection($users);
        }
        
    }
    public function statusUpdate(Request $request){
        $user = User::find($request->input('id'));
        $user->permissions = $request->input('status');
        $user->update();
        return new UserBasicResource($user);
    }

    public function agency(){
        // return $users_id = DB::table('role_users')->where('role_id',3)->select('user_id')->get()->toArray();
        // $user = User::paginate(5);
        $user = User::join('role_users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id',3)
            ->select('users.*')
            ->get();
        return UserBasicResource::collection($user);
    }

    public function applicant(){
        // return $users_id = DB::table('role_users')->where('role_id',3)->select('user_id')->get()->toArray();
        // $user = User::paginate(5);
        $user = User::join('role_users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id',6)
            ->select('users.*')
            ->get();
        return UserBasicResource::collection($user);
    }

    public function finatialAndTraining(Request $request){
        $role_id = $request->role_id;
        // return $users_id = DB::table('role_users')->where('role_id',3)->select('user_id')->get()->toArray();
        // $user = User::paginate(5);
        $user = User::join('role_users', 'users.id', '=', 'role_users.user_id')->where('role_users.role_id',$role_id)->orderBy('users.id','DESC')
            ->select('users.*')
            ->paginate(10);
        return UserBasicResource::collection($user);
    }
    

    public function specificContact($type){
        
        if($type==1){
            $user = User::whereIn('type',[1,2])->get();
        }elseif($type==4){
            $user = User::whereIn('type',[1,2,3])->get();
        }else{
            $user = User::where('type',$type)->get();
        }
        // return $user;
        // return response()->json(['error'=>$user],400);
        return UserBasicResource::collection($user);
    }

    public function pagination(Request $request){


        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);

        $id = [];
        $created_user = Contact::where('created_by',$user_id)->get();
        foreach ($created_user as $key => $data) {
            array_push($id, $data->user_id);
        }

        $search_item = ($request->has('search_item'))?$request['search_item']:null;
        
        $type = ($request->has('type'))?$request['type']:null;
        if($type==10){
            $type = null;
            $type2=[1,2];
        }else{
            $type2=null;
        }
        $user = '';
        if ($role->hasAccess(['contact.view']))
        {
            $user  = User::whereNotIn('id', [1])->when($search_item && $type, function($q) use($search_item,$type,$id){return $q->whereIn('id',$id)->where('type',$type)->where('name','like',"%$search_item%");})
            ->when($search_item, function($q) use($search_item,$id){return $q->whereIn('id',$id)->where('name','like',"%$search_item%")->orWhere('email','like',"%$search_item%");})
            ->when($type, function($q) use($type,$id){return $q->whereIn('id',$id)->where('type',$type);})
            ->when($type2, function($q) use($type2,$id){return $q->whereIn('id',$id)->whereIn('type',$type2);})
            ->when($id, function($q) use($id){return $q->whereIn('id',$id);})
            ->orderBy('name','asc')->paginate(50);
        }
        if ($role->hasAccess(['contact.viewall']))
        {
            $user  = User::whereNotIn('id', [1])->when($search_item && $type, function($q) use($search_item,$type){return $q->where('type',$type)->where('name','like',"%$search_item%");})
            ->when($search_item, function($q) use($search_item){return $q->where('name','like',"%$search_item%")->orWhere('email','like',"%$search_item%");})
            ->when($type, function($q) use($type){return $q->where('type',$type);})
            ->when($type2, function($q) use($type2){return $q->whereIn('type',$type2);})
            ->orderBy('name','asc')->paginate(50);
        }
                
        return UserBasicResource::collection($user);
    }

    public function store(Request $request)
    {
         // return $request->input('role_id').' '.$request->input('name');
         if( $request->isMethod('post')){

            if($request->input('role_id') == 4||$request->input('role_id') == 5||$request->input('role_id') == 7){
                $rules = array(
                    'role_id'    => 'required',
                    'phone'      => 'required|digits:11|unique:users',
                );
                $messsages = array(
                   'digits'  =>'11 ডিজিট হতে হবে',
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'unique'  => 'এই ফোন অলরেডি রেজিস্টার করা  আছে',
                );

                $validator = Validator::make($request->all(),$rules,$messsages);
                if($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 400);
                }

                $type  = $request->input('role_id');
                $name  = $request->input('name');
                $phone = $request->input('phone');
                $email = $request->input('email');
                $password = str_random(6);

                $credentials = [
                    'role_id'  => $type,
                    'type'     => $type,
                    'name'     => $name,
                    'phone'    => $phone,
                    'email'    => $email,
                    'password' => $password,
                ];
            }
            else{
                $validatedData = $request->validate([
                    'email'   => 'required|email|unique:users',
                    'role_id' => 'required',
                ]);

                $log_user = Auth()->user();
                $type = $request->input('type');
                $name = $request->input('name');
                $email = $request->input('email');
                $phone = $request->input('phone');
                $password = str_random(6);

                $credentials = [
                    'type'     => $type,
                    'role_id'  => $type,
                    'name'     => $name,
                    'phone'    => $phone,
                    'email'    => $email,
                    'password' => $password,
                ]; 
            }
            
            // Sentinel::registerAndActivate(['type'=>$type,'name'=>$name,'email'=>$email,'password' => $password]);
            $user = Sentinel::register($credentials);
            $activation = Activation::create($user);

            $role_id = $request->input('role_id');
            $role = Sentinel::findRoleById($role_id);
            $role->users()->attach($user);
            $log_user = Auth::user();

            $contact = new Contact;
            $contact -> user_id = $user->id;

            $contact -> type        = $request->input('training_type');
            $contact -> designation = $request->input('designation');
            $contact -> father_name = $request->input('father_name');
            $contact -> mother_name = $request->input('mother_name');
            $contact -> spouse_name = $request->input('spouse_name');
            $contact -> area_code = $request->input('area_code');
            $contact -> mobile_number = $request->input('mobile_number');
            $contact -> contact_number = $request->input('contact_number');
            $contact -> occupation = $request->input('occupation');
            $contact -> nid = $request->input('nid');
            $contact -> birthday = $request->input('birthday');
            $contact -> district_id = $request->input('district_id');
            $contact -> subdistrict_id = $request->input('subdistrict_id');
            $contact -> ward_union = $request->input('ward_union');
            $contact -> area_village = $request->input('area_village');
            $contact -> street_para = $request->input('street_para');
            $contact -> post_ofiice = $request->input('post_ofiice');
            $contact -> company_name = $request->input('company_name');
            $contact -> agent_id = $request->input('agent_id');
            $contact -> website = $request->input('website');
            $contact -> about = $request->input('about');
            $contact -> registration_number = $request->input('registration_number');
            $contact -> country_name = json_encode($request->input('country'));
            $contact -> address = json_encode($request->input('address'));
            $contact -> service_name = $request->input('service_name');
            $contact -> service_url = $request->input('service_url');

            // if($request->not_edit_image == 10){
            //     $contact -> image = $request->image;
            // }
            

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
                $contact->image = $request->image;
            }

            $contact -> created_by = $log_user->id;
            $contact -> updated_by = $log_user->id;
            if($contact->save()){
                $user = User::find($user->id);
                return new UserBasicResource($user);
            }

        }

        if( $request->isMethod('put')){

             $contact_id = $request->contact_id;
             if($request->input('user_id')){
                $user = User::find($request->input('user_id'));
                $contact_id = $user->contact->id;
                $user->name = $request->input('name');
                $user->save();
             }
             $contact = Contact::find($contact_id);
             $id = $contact->user->id;
            
            if($request->input('email')){
                $validatedData = $request->validate([
                    'email'=>'required|email|unique:users,email,'.$id,
                ]);
             }

            if($request->input('role_id') == 4 || $request->input('role_id') == 5 || $request->input('role_id') == 7){
                $rules = array(
                    'role_id'    => 'required',
                    'phone'      => 'required|digits:11|unique:users,phone,'.$id,
                );
                $messsages = array(
                   'digits'  =>'11 ডিজিট হতে হবে',
                   'required'=>'এই ঘরটি পূরণ করা আবশ্যক',
                   'unique'  => 'এই ফোন অলরেডি রেজিস্টার করা আছে',
                );

                $validator = Validator::make($request->all(),$rules,$messsages);
                if($validator->fails()) {
                    return response()->json(['errors' => $validator->errors()], 400);
                }
            }
            
            $log_user = Auth()->user();

            if(!$request->input('user_id')){
                $type = $request->input('type');
                $name = $request->input('name');
                $email = $request->input('email');
                $phone = $request->input('phone');
                $user = User::whereId($id)->first();
                if(!$type){
                    $type = $request->input('role_id');
                }
                $user->type =  $type;
                $user->role_id = $type;
                $user->name =  $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->save();
                // $role_id  = $request->role_id;
            
                // $old_role_id = $request->old_role_id;

                
                // $old_role = Sentinel::findRoleById($old_role_id);
                // if($old_role){
                //     $old_role->users()->detach($user);
                // }
                // $role = Sentinel::findRoleById($role_id);
                // $role->users()->attach($user);
            }
            


            $contact -> type           = $request->input('training_type');
            $contact -> designation_id = $request->input('designation_id');
            $contact -> designation = $request->input('designation');
            $contact -> father_name = $request->input('father_name');
            $contact -> mother_name = $request->input('mother_name');
            $contact -> spouse_name = $request->input('spouse_name');
            $contact -> area_code = $request->input('area_code');
            $contact -> mobile_number = $request->input('mobile_number');
            $contact -> contact_number = $request->input('contact_number');
            $contact -> occupation = $request->input('occupation');
            $contact -> nid = $request->input('nid');
            $contact -> birthday = $request->input('birthday');
            $contact -> district_id = $request->input('district_id');
            $contact -> subdistrict_id = $request->input('subdistrict_id');
            $contact -> division_id = $request->input('division_id');
            $contact -> ward_union = $request->input('ward_union');
            $contact -> area_village = $request->input('area_village');
            $contact -> street_para = $request->input('street_para');
            $contact -> post_ofiice = $request->input('post_ofiice');
            $contact -> company_name = $request->input('company_name');
            $contact -> agent_id = $request->input('agent_id');
            $contact -> website = $request->input('website');
            $contact -> about = $request->input('about');
            $contact -> registration_number = $request->input('registration_number');
            $contact -> country_name = json_encode($request->input('country'));
            $contact -> address = json_encode($request->input('address'));
            $contact -> service_name = $request->input('service_name');
            $contact -> service_url = $request->input('service_url');

            if($request->input('personal')){
                $contact -> personal = json_encode($request->input('personal'));
            }
            if($request->input('division')){
                $contact->address2  = json_encode($request->only('division', 'district', 'subdistrict'));
            }

            if($request->input('nominee')){
                $contact -> nominee = json_encode($request->input('nominee'));
            }

            if($request->input('educations')){
                $contact -> educations = json_encode($request->input('educations'));
            }

            if($request->input('languages')){
                $contact -> languages = json_encode($request->input('languages'));
            }

            if($request->input('experiences')){
                $contact -> experiences = json_encode($request->input('experiences'));
            }

            if($request->input('trainings')){
                $contact -> trainings = json_encode($request->input('trainings'));
            }

            if($request->input('address2')){
                $contact -> address2 = json_encode($request->input('address2'));
                $contact -> address3 = json_encode($request->input('address3'));
                $contact -> same_address = $request->input('same_address');
            }
            $contact -> updated_by =  $log_user->id;

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
            
            if($contact->save()){
                return new UserBasicResource($user);
            }

        }
        
    }

    
    public function show($id)
    {
        // return "okkkk";
        $user = User::findOrFail($id);
        return new UserBasicResource($user);
    }
    
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        DB::table('contacts')->where('user_id',$id)->delete();
        DB::table('role_users')->where('user_id',$id)->delete();
        if($user->delete()){
        	return response()->json(['success'=>'Delete successfully'],200);
        }
    }

    public function checkProgress(){
        $user_id = Auth::user()->id;
        $contact = Contact::where('user_id',$user_id)->get()->first();
        $progress = 20;
        if($contact->personal_status == 1){
            $progress =  $progress + 15;
        }
        if($contact->image != null){
            $progress =  $progress + 5;
        }
        if($contact->nominee != null){
            $progress =  $progress + 10;
        }
        if($contact->educations != null){
            $progress =  $progress + 10;
        }
        if($contact->languages != null){
            $progress =  $progress + 10;
        }
        if($contact->experiences != null){
            $progress =  $progress + 10;
        }
        if($contact->trainings != null){
            $progress =  $progress + 10;
        }
        if($contact->address2 != null){
            $progress =  $progress + 10;
        }
        return $progress;
    }
    public function personalInfo(Request $request){
        $contact = Contact::where('user_id',Auth::user()->id)->get()->first();
        if($contact->nid == null){
            $rules = array(
                'nid'             => 'unique:contacts',
            );
            $messsages = array(
               'unique' => 'এই এনআইডি অলরেডি রেজিস্টার করা  আছে',
            );

            $validator = Validator::make($request->all(),$rules,$messsages);
            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
        }
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $country_data = [];
            $job_data = [];
            foreach ($request->personal['country'] as $key => $value) {
                $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                array_push($country_data,$temp);
            }
            foreach ($request->personal['job'] as $key => $value) {
                $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                array_push($job_data,$temp);
            }
            CountryApplicant::where('user_id',$user_id)->delete();
            CountryApplicant::insert($country_data);

            DesiredJobApplicant::where('user_id',$user_id)->delete();
            DesiredJobApplicant::insert($job_data);

            $user = User::find($user_id);
            $user->name = $request->name;
            $user->update();

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->personal = json_encode($request->input('personal'));
            $contact->personal_status = $request->personal_status;
            $contact->father_name = $request->personal['father_name'];
            $contact->mother_name = $request->personal['mother_name'];
            $contact->spouse_name = $request->personal['spouse_name'];
            $contact->nationality = $request->personal['nationality'];
            $contact->district_id = is_array($request->personal['district'])?$request->personal['district']['id']:'';
            $contact->country_id  = is_array($request->personal['country_name'])?$request->personal['country_name']['id']:'';
            $contact->gender      = $request->personal['sex'];
            $contact->m_status    = $request->personal['marital_status'];
            $contact->religion    = $request->personal['religion'];
            $contact->weight      = $request->personal['weight'];
            $contact->height      = $request->personal['height'];
            $contact->nid         = $request->personal['nid'];
            $contact->passport_number = $request->personal['passport_no'];
            $contact->passport_issue_date = $request->personal['passport_date'];
            $contact->birthday = $request->personal['birth_date'];
            $contact->b_boy    = $request->personal['no_son'];
            $contact->b_girl   = $request->personal['no_daughter'];

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
                $contact->image = url('/').'/images/'.$fileName;
            }else{
                $contact->image = $request->image;
            }
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();

            DB::commit();

            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function addresslInfo(Request $request){
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact ->address2 = json_encode($request->input('address2'));
            $contact ->address3 = json_encode($request->input('address3'));
            $contact ->same_address = $request->input('same_address');
            $contact->update();

            $contact->progress = $this->checkProgress();
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

            $user = User::find($user_id);
            DB::commit();

            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }

    }

    public function nomineeInfo(Request $request){
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->nominee = json_encode($request->input('nominee'));
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();

            $nominee = [
                'user_id' => $user_id,
                'name'    => $request->nominee['name'],
                'relation'=> $request->nominee['relation'],
                'phone'   => $request->nominee['phone'],
                'address' => $request->nominee['address']
            ];

            Nominee::where('user_id',$user_id)->delete();
            Nominee::insert($nominee);
            $user = User::find($user_id);
            DB::commit();
            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function educationInfo(Request $request){

        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $i = 0;
            $education_data = [];
            foreach ($request->educations as $key => $value) {
                $i++;
                $temp = [
                    'user_id'       =>  $user_id,
                    'board'         =>  $value['board'],
                    'passing_year'  =>  $value['p_year'],
                    'degree_name'   =>  $value['degree'],
                    'institute'     =>  $value['institute'],
                    'subject'       =>  $value['subject'],
                    'grade'         =>  $value['grade'],
                ];
                array_push($education_data,$temp);
            }

            Education::where('user_id',$user_id)->delete();
            Education::insert($education_data);

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->educations = $i>0?json_encode($request->input('educations')):'';
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();

            $user = User::find($user_id);
            DB::commit();
            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function languageInfo(Request $request){
        try{
            DB::beginTransaction();

            $user_id = Auth::user()->id;
            $laguage_data = [];
            $i = 0;
            foreach ($request->languages as $key => $value) {
                $i++;
                $temp = [
                    'user_id'        =>  $user_id,
                    'lanuage_id'      =>  $value['language']['id'],
                    'speaking_skill'  =>  $value['oral_skill'],
                    'written_skill'   =>  $value['writing_skill'],
                ];
                array_push($laguage_data,$temp);
            }

            LanguageApllicant::where('user_id',$user_id)->delete();
            LanguageApllicant::insert($laguage_data);

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->languages = $i>0?json_encode($request->input('languages')):'';
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();

            $user = User::find($user_id);
            DB::commit();
            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function experienceInfo(Request $request){
        try{ 
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $experience_data = [];
            $i = 0;
            foreach ($request->experiences as $key => $value) {
                $i++;
                $d1 = new DateTime($value['serve_form']);
                $d2 = new DateTime($value['serve_till']);
                $diff = $d2->diff($d1);
                $temp = [
                    'user_id'           =>  $user_id,
                    'company_name'      =>  $value['company_name'],
                    'designation'       =>  $value['post_held'],
                    'start'             =>  $value['serve_form'],
                    'end'               =>  $value['serve_till'],
                    'phone'             =>  $value['phone'],
                    'contact_person'    =>  $value['contact_person'],
                    'email'             =>  $value['email'],
                    'responsilbility'   =>  $value['responsibility'],
                    'achievement'       =>  $value['achievement'],
                    'duration_m'        =>  $diff->m,
                    'duration_y'        =>  $diff->y
                ];
                array_push($experience_data,$temp);
            }

            Experience::where('user_id',$user_id)->delete();
            Experience::insert($experience_data);

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->experiences = $i>0?json_encode($request->input('experiences')):'';
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();
            $user = User::find($user_id);
            DB::commit();
            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function trainingInfo(Request $request){
        try{ 
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            if($user_id == 1){
               $user_id = $request->user_id; 
            }
            $training_data = [];
            $i = 0;
            foreach ($request->trainings as $key => $value) {
                $i++;
                $temp = [
                    'user_id'            =>  $user_id,
                    'training_name'      =>  $value['training_name'],
                    'training_center_id' =>  $value['training_center']['id'],
                    'time_tense'         =>  $value['duration'],
                    'description'        =>  $value['description']
                ];
                array_push($training_data,$temp);
            }

            Training::where('user_id',$user_id)->delete();
            Training::insert($training_data);

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->trainings = $i>0?json_encode($request->input('trainings')):'';

            if(Auth::user()->id == 1){
               $contact->t_by_admin = 1; 
            }
            $contact->update();

            $contact->progress = $this->checkProgress();
            $contact->update();
            
            $user = User::find($user_id);
            DB::commit();
            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function basicInfo(Request $request){
        $contact = Contact::where('user_id',Auth::user()->id)->get()->first();
        if($contact->registration_number == null){
            $rules = array(
                'registration_number' => 'unique:contacts',
            );
            $messsages = array(
               'unique' => 'এই রেজিস্ট্রেশন নম্বর অলরেডি রেজিস্টার করা  আছে',
            );

            $validator = Validator::make($request->all(),$rules,$messsages);
            if($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }
        }
        try{
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $country_data = [];
            $job_data = [];
            foreach ($request->personal['country'] as $key => $value) {
                $temp = ['user_id'=>$user_id, 'country_id'=>  $value];
                array_push($country_data,$temp);
            }
            foreach ($request->personal['job'] as $key => $value) {
                $temp = ['user_id'=>$user_id, 'job_id'=>  $value];
                array_push($job_data,$temp);
            }
            CountryAgent::where('user_id',$user_id)->delete();
            CountryAgent::insert($country_data);

            DesireJobAgent::where('user_id',$user_id)->delete();
            DesireJobAgent::insert($job_data);

            $user = User::find($user_id);
            $user->name = $request->name;
            $user->update();

            $contact = Contact::where('user_id',$user_id)->get()->first();
            $contact->personal  = json_encode($request->input('personal'));
            $contact->address   = json_encode($request->input('address'));
            $contact->address2  = json_encode($request->only('division','district','subdistrict'));
            $contact->registration_number = $request->registration_number;
            $contact->contact_number      = $request->phone2;
            $contact->website             = $request->website;
            $contact->map_link            = $request->map_link;
            $contact->about               = $request->about;
            $contact->division_id         = $request->division_id;
            $contact->district_id         = $request->district_id;
            $contact->subdistrict_id      = $request->subdistrict_id;
            $contact->update();

            DB::commit();

            return new UserBasicResource($user);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['errors'=>['status' => false , 'message' => 'something went wrong!!']] , 401);
        }
    }

    public function galleryInfo(Request $request){
        $user_id = Auth::user()->id;
        if($request->hasFile('files')){
            $gallery_data = [];
            $names = $request->names;
            $type = $request->type;
            foreach ($request->file('files') as $key => $file) {
                $fileName = time().''.$file->getClientOriginalName();
                $file->move(public_path('images'),$fileName);

                $temp = [
                    'user_id'            =>   $user_id,
                    'type'               =>   $type,
                    'image'              =>   url('/').'/images/'.$fileName,
                    'name'               =>   $names[$key]
                ];
                array_push($gallery_data,$temp);
            }

            
            $data = Gallery::insert($gallery_data);

            $photos = Gallery::where('user_id',$user_id)->where('type',$type)->orderBy('id','DESC')->paginate(6);
            return $photos;
        }
        
        $gallery = new Gallery;

        $exploded = explode(',', $request->image);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0], 'jpeg'))
            $extension = 'jpg';
        else
            $extension = 'png';

        $fileName = str_random().'.'.$extension;
        $path = public_path().'/images/'.$fileName;
        file_put_contents($path, $decoded);

        $gallery->image  = url('/').'/images/'.$fileName;
        $gallery->type   =  $request->type;
        $gallery->name   =  $request->name;
        $gallery->user_id = Auth::user()->id;
        $gallery->save();

        return $gallery;
    }

    public function getGallery(Request $request){
        $user_id = $request->user_id;
        $type   = $request->type;
        $limit  = $request->limit;
        $photos = Gallery::where('user_id',$user_id)->where('type',$type)->orderBy('id','DESC')->paginate($limit);
        return $photos;
    }

    public function galleryDelete($id){
        $photos = Gallery::where('id',$id)->delete();
        return $photos;
    }

    public function getGallery2(Request $request){
        $user   = User::where('slug',$request->slug)->get()->first();
        $limit  = $request->limit;
        $type   = $request->type;
        $photos = Gallery::where('user_id',$user->id)->where('type',$type)->orderBy('id','DESC')->paginate($limit);
        $photos = GalleryResources:: collection($photos);
        return $photos;
    }

    public function getAgencyInfo(Request $request){
        $user    = User::where('slug',$request->slug)->get()->first();
        $contact = Contact::where('user_id',$user->id)->get()->first();
        $address = json_decode($contact->address);
        $job_id   = DesireJobAgent::where('user_id',$user->id)->select('job_id')->get();
        $job      = DesiredJob::whereIn('id',$job_id)->get();
        $country_id = CountryAgent::where('user_id',$user->id)->select('country_id')->get();
        $country = DB::table('apps_countries')->whereIn('id',$country_id)->get();
        $slider  = Gallery::where('user_id',$user->id)->where('type','slider')->get();

        $avg_rating = DB::table('rating_riviews')->where('agency_id',$user->id)->avg('rating')?DB::table('rating_riviews')->where('agency_id',$user->id)->avg('rating'):0;

        $user_id = $user->id;
        $one  = DB::table('rating_riviews')->where('agency_id',$user_id)->where('rating','>=',1)->where('rating','<',2)->get()->count();
        $two  = DB::table('rating_riviews')->where('agency_id',$user_id)->where('rating','>=',2)->where('rating','<',3)->get()->count();
        $three  = DB::table('rating_riviews')->where('agency_id',$user_id)->where('rating','>=',3)->where('rating','<',4)->get()->count();
        $four  = DB::table('rating_riviews')->where('agency_id',$user_id)->where('rating','>=',4)->where('rating','<',5)->get()->count();
        $five  = DB::table('rating_riviews')->where('agency_id',$user_id)->where('rating','>=',5)->get()->count();

        $total = DB::table('rating_riviews')->where('agency_id',$user->id)->where('parent_comment_id',null)->get()->count();
        return response()->json(['user'=>$user,'contact'=>$contact,'address'=>$address,'job'=>$job,'country'=>$country,'slider'=>$slider,'avg_rating'=>$avg_rating,'one'=>$one,'two'=>$two,'three'=>$three,'four'=>$four,'five'=>$five,'total'=>$total],200);
    }
}

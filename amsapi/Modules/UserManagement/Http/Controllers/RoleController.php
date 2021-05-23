<?php

namespace Modules\UserManagement\Http\Controllers;

use App\User;
use Sentinel;
use DB;
// use App\RoleUser;
use Modules\UserManagement\Transformers\Role as RoleResource;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class RoleController extends Controller
{
    
    
    public function index(Request $request)
    {   
        $role = DB::table('roles')->get();
        // $role = DB::table('roles')->get();
        return RoleResource::collection($role);
    }

    public function index2()
    {   
        $user_id = Auth()->user()->id;
        $role_id = RoleUser::where('user_id',$user_id)->first()->role_id;
        $role = Sentinel::findRoleById($role_id);
        return new RoleResource($role);
    }

    public function index3()
    {   
        $role = DB::table('roles')->whereNotIn('id', [1,2])->get();
        // $role = DB::table('roles')->get();
        return RoleResource::collection($role);
    }

    public function store(Request $request)
    {
        // validator 
        $validate = $request->validate([
              'name' => 'required|unique:roles',  
        ]);
        // return $request ;
        $data = $request->all();
        try{
            $name = $request->name;
            $slug = strtolower($request->name);
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => $name,
                'slug' => $slug,
            ]);
            
            $role->permissions = [

                'role.view'   => $data['permission']['role_view'],   
                'role.viewall'   => $data['permission']['role_viewall'],   
                'role.create' => $data['permission']['role_create'],
                'role.update' => $data['permission']['role_update'],
                'role.updateall' => $data['permission']['role_updateall'],
                'role.delete' => $data['permission']['role_delete'],
                'role.deleteall' => $data['permission']['role_deleteall'],


                'user.view'   => $data['permission']['user_view'],   
                'user.viewall'   => $data['permission']['user_viewall'],   
                'user.create' => $data['permission']['user_create'],
                'user.update' => $data['permission']['user_update'],
                'user.updateall' => $data['permission']['user_updateall'],
                'user.delete' => $data['permission']['user_delete'],
                'user.deleteall' => $data['permission']['user_deleteall'],

            ];

            $role->permissions2 = json_encode([
                
                'role_view'   => $data['permission']['role_view'],   
                'role_viewall'   => $data['permission']['role_viewall'],   
                'role_create' => $data['permission']['role_create'],
                'role_update' => $data['permission']['role_update'],
                'role_updateall' => $data['permission']['role_updateall'],
                'role_delete' => $data['permission']['role_delete'],
                'role_deleteall' => $data['permission']['role_deleteall'],    

                'user_view'   => $data['permission']['user_view'],   
                'user_viewall'   => $data['permission']['user_viewall'],   
                'user_create' => $data['permission']['user_create'],
                'user_update' => $data['permission']['user_update'],
                'user_updateall' => $data['permission']['user_updateall'],
                'user_delete' => $data['permission']['user_delete'],
                'user_deleteall' => $data['permission']['user_deleteall'],    

            ]);

            // $log_user = Auth()->user();
            // $role->created_by = $log_user->id;
            // $role->updated_by = $log_user->id;
            if($role->save()){
                return $role;
                return new RoleResource($role);
            }
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'Role name must be unique'],400);
        }
    }

    public function update(Request $request)
    {
        //return $request->all();
        $role = Sentinel::findRoleById($request->id);
        
        $validate = $request->validate([
              'name' => 'required|unique:roles,name,'.$role->id,  
        ]);
        try{
            
            $slug = strtolower($request->input('name'));

            $role->name = $request->input('name');
            $role->slug = $slug;
            $data = $request->all();
            $role->permissions = [

                'role.view'   => $data['permission']['role_view'],   
                'role.viewall'   => $data['permission']['role_viewall'],   
                'role.create' => $data['permission']['role_create'],
                'role.update' => $data['permission']['role_update'],
                'role.updateall' => $data['permission']['role_updateall'],
                'role.delete' => $data['permission']['role_delete'],
                'role.deleteall' => $data['permission']['role_deleteall'],


                'user.view'   => $data['permission']['user_view'],   
                'user.viewall'   => $data['permission']['user_viewall'],   
                'user.create' => $data['permission']['user_create'],
                'user.update' => $data['permission']['user_update'],
                'user.updateall' => $data['permission']['user_updateall'],
                'user.delete' => $data['permission']['user_delete'],
                'user.deleteall' => $data['permission']['user_deleteall'],

            ];

            $role->permissions2 = json_encode([
                
                'role_view'   => $data['permission']['role_view'],   
                'role_viewall'   => $data['permission']['role_viewall'],   
                'role_create' => $data['permission']['role_create'],
                'role_update' => $data['permission']['role_update'],
                'role_updateall' => $data['permission']['role_updateall'],
                'role_delete' => $data['permission']['role_delete'],
                'role_deleteall' => $data['permission']['role_deleteall'],    

                'user_view'   => $data['permission']['user_view'],   
                'user_viewall'   => $data['permission']['user_viewall'],   
                'user_create' => $data['permission']['user_create'],
                'user_update' => $data['permission']['user_update'],
                'user_updateall' => $data['permission']['user_updateall'],
                'user_delete' => $data['permission']['user_delete'],
                'user_deleteall' => $data['permission']['user_deleteall'],    

            ]);
            // $log_user = Auth()->user();
            // $role->updated_by = $log_user->id;
             // return $role;
            if($role->save()){
                return new RoleResource($role);
            }
        }
        catch (QueryException $e) {
            return response()->json(['error'=>'Some This Probelm'],400);
        }
       
        
    }
    // public function detail($id){
    //     $role = Sentinel::findRoleByID($id);

    // }
    
    public function destroy($id)
    {
        $role = Sentinel::findRoleById($id);


        // $guest = Sentinel::findRoleByName('Guest');
        // if($id != $guest->id){
        //     if($role->delete()){
        //         return new RoleResource($role);
        //     }
        // }
        // else{
        //     return response()->json("Not Possible",401);
        // }

        if($role->delete()){
            return new RoleResource($role);
        }
        
    }

    public function getPermission($id)
    {
        $role = Sentinel::findRoleById($id);
        $contact_view   = $role->permissions["contact.view"];
        $contact_create = $role->permissions["contact.create"];
        $contact_update = $role->permissions["contact.update"];
        $contact_delete = $role->permissions["contact.delete"];

        $permission = ['contact_view'=>$contact_view,'contact_create'=>$contact_create,'contact_update'=>$contact_update,'contact_delete'=>$contact_delete];
        return response()->json($permission,200);
    }

    public function updatePermission(Request $request)
    {
        $role_id        = $request->input('role_id');
        $contact_view   = $request->input('contact_view');
        $contact_create = $request->input('contact_create');
        $contact_update = $request->input('contact_update');
        $contact_delete = $request->input('contact_delete');

        $role = Sentinel::findRoleById($role_id);

        $role->permissions = [
            'contact.view'   => $contact_view,
            'contact.create' => $contact_create,
            'contact.update' => $contact_update,
            'contact.delete' => $contact_delete,
        ];
        $role->save();
        $contact_view   = $role->permissions["contact.view"];
        $contact_create = $role->permissions["contact.create"];
        $contact_update = $role->permissions["contact.update"];
        $contact_delete = $role->permissions["contact.delete"];

        $permission = ['contact_view'=>$contact_view,'contact_create'=>$contact_create,'contact_update'=>$contact_update,'contact_delete'=>$contact_delete];
        return response()->json($permission,200);
    }


    public function testRole(){

       $role_info = DB::table('role_users')
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->get();

        return response()->json($role_info,200);
    }

    public function getAssignRole(){

      $role_info = DB::table('role_users')->whereNotIn('role_id', [1,2])
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->get();

      return response()->json($role_info,200);
    }

    public function updateAssignRole(Request $request){

        $role_id     = $request->role_id;
        $old_role_id = $request->old_role_id;
        $user_id     = $request->user_id;

        $user = Sentinel::findById($user_id);
        $old_role = Sentinel::findRoleById($old_role_id);

        if($old_role){
            $old_role->users()->detach($user);
        }
        
        $role = Sentinel::findRoleById($role_id);
        $role->users()->attach($user);

      $role_info = DB::table('role_users')
        ->join('users', 'users.id', '=', 'role_users.user_id')
        ->join('roles', 'roles.id', '=', 'role_users.role_id')
        ->select('users.name as user_name','users.email','roles.name as role_name','role_users.*')
        ->where('users.id', $user_id)
        ->get();

      return response()->json($role_info,200);
    }
}

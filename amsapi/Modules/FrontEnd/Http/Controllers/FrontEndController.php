<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\FrontEnd\Entities\SiteInfo;
use Modules\FrontEnd\Entities\Language;
use Modules\FrontEnd\Transformers\Language as LanguageResource;
use Modules\FrontEnd\Transformers\SiteInfo as SiteInfoResource;
use Modules\FrontEnd\Transformers\Content as ContentResource;
use Modules\FrontEnd\Transformers\UserResource as UserResource;
use Modules\FrontEnd\Entities\Content;
use Modules\FrontEnd\Entities\User;
use DB;
class FrontEndController extends Controller
{
    public function contentDownload($id){
        $Content = Content::find($id);
        $file = public_path(). "/uploads/".$Content->file_name;
        return response()->download($file, 'form.pdf');
    }

    public function lanAll()
    {
        $Language = Language::all();
        return LanguageResource::collection($Language);
    }

    public function lanGet($id){
        $Language = Language::where('id',$id)->get();
        return new LanguageResource($Language);
    }

    public function SiteInfo($id){
        $SiteInfo = SiteInfo::where('language_id',$id)->first();
        return new SiteInfoResource($SiteInfo);
    }

    public function contents(Request $request){
        
        $category     = ($request->has('category'))?$request['category']:null;
        $limit        = ($request->has('limit'))?$request['limit']:4;
        $Content = Content::when($category,function($q) use($category){return $q->where('content_category_id', $category);})->orderBy('id','DESC')->paginate($limit);
        return ContentResource::collection($Content);
    }
    public function sliders(){
        $Content = Content::all();
        return ContentResource::collection($Content);
    }

    public function user(Request $request){
        // return $request->all();
        $role          = ($request->has('role'))?$request['role']:null;
        $name          = ($request->has('name'))?$request['name']:null;
        $training_type = ($request->has('training_type'))?$request['training_type']:null;
        $address       = ($request->has('address'))?$request['address']:null;
        // ->where('role_users.role_id',$role)
        if($role == 3){
            $data = User::join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $role)->when($name,function($q) use($name){return $q->where('users.name','LIKE','%'.$name.'%');})
            ->leftJoin('rating_riviews', 'rating_riviews.agency_id', '=', 'users.id')->select('users.*', DB::raw('AVG(rating) as ratings_average' ))->groupBy('users.id')->orderBy('ratings_average', 'DESC')->paginate(10);
            // ->when($name,function($q) use($name){return $q->where('users.name','LIKE','%'.$name.'%');})
            // ->orderBy('users.id', 'DESC')
            // ->select('users.*')->paginate(10);
            return UserResource::collection($data);
        }else{
            $data = User::when($role,function($q) use($role){return $q->join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $role);})
            ->when($name,function($q) use($name){return $q->where('users.name','LIKE','%'.$name.'%');})
            ->when($address,function($q) use($address){return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.address','LIKE','%'.$address.'%');})
            ->when($training_type,function($q) use($training_type,$address){
                if($address == null)
                    return $q->join('contacts','contacts.user_id','=','users.id')->where('contacts.type',$training_type);
                else
                    return $q->where('contacts.type',$training_type);
            })
            ->orderBy('users.id', 'DESC')
            ->select('users.*')->paginate(10);
            return UserResource::collection($data);
        }
    }
    public function userDetails($id){
        $user = User::find($id);
        return new UserResource($user);

    }

    public function userTotal(Request $request){

        $role = ($request->has('role'))?$request['role']:null;
        return $data = User::when($role,function($q) use($role){return $q->join('role_users','role_users.user_id','=','users.id')->where('role_users.role_id', $role);})->count();
    }
    


    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

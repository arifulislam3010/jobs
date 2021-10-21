<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\FrontEnd\Entities\Category;
use Modules\FrontEnd\Entities\Area;
use Modules\FrontEnd\Entities\Post;
use Modules\FrontEnd\Entities\PostSection;


use Modules\FrontEnd\Entities\PostCategory;
use Modules\FrontEnd\Transformers\Post as PostResource;
use Modules\FrontEnd\Transformers\Area as AreaResource;
use Modules\FrontEnd\Transformers\Category as CategoryResource;
use Modules\FrontEnd\Transformers\PostSection as PostSectionResource;
use Modules\FrontEnd\Transformers\AgencyResource;

use Modules\Post\Transformers\PostDetail ;
use Modules\Setting\Entities\Section;

use App\DesiredJob;
use App\Country;
use App\User;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function area($title){
        $area = Area::where('title',$title)->first();
        $garea = Area::where('parent_id',$area->id)->get();
        return AreaResource::collection($garea);
    }
    public function index(Request $request)
    {
        $all_agency  = User::where('type',3)->pluck('id');
        $all_country = Country::where('deleted_at',null)->pluck('id');
        $all_job     = DesiredJob::where('deleted_at',null)->pluck('id');

        $country = $request->input('country')?$request->input('country'):[];
        $job     = $request->input('job')?$request->input('job'):[];
        $agency  = $request->input('agency')?$request->input('agency'):[];

        $country_id = count($country)?($country[0]==99999?$all_country:$country):[];
        $job_id     = count($job)?($job[0]==99999?$all_job :$job):[];
        $agency_id  = count($agency)?($agency[0]==99999?$all_agency:$agency):[];

        // $section     = ($request->has('section'))?$request['section']:null;
        // $category     = ($request->has('category'))?$request['category']:null;
        // $tag     = ($request->has('tag'))?$request['tag']:null;
        // $area     = ($request->has('area'))?$request['area']:null;
        // $limit     = ($request->has('limit'))?$request['limit']:10;
        // $search     = ($request->has('search'))?$request['search']:null;
        // $popular     = ($request->has('popular'))?$request['popular']:null;
        // $latest     = ($request->has('latest'))?$request['latest']:null;
        // $type     = ($request->has('type'))?$request['type']:null;
        // if($area!=null){
        //     $garea = Area::where('title',$area)->first();
        //     if($garea){
        //         $area = $garea->id;
        //     }else{
        //         $area = null;
        //     }
        // }
        // if($popular==1){
        //      $post = Post::select('posts.*')->orderBy('posts.view', 'DESC')->paginate($limit);
        //     return PostResource::collection($post);
        // }

        // $post = Post::select('posts.*')
        //     ->when($section,function($q) use($section){return $q->join('post_sections','post_sections.post_id','=','posts.id')->where('post_sections.section_id', $section);})
        //     ->when($category,function($q) use($category){return $q->join('post_categories','post_categories.post_id','=','posts.id')->where('post_categories.category_id', $category);})
        //     ->when($tag,function($q) use($tag){return $q->join('post_tags','post_tags.post_id','=','posts.id')->where('post_tags.tag_id',$tag);})
        //     ->when($area,function($q) use($area){return $q->join('post_areas','post_areas.post_id','=','posts.id')->where('post_areas.area_id', $area);})
        //     ->where('posts.type',$type)
        //     ->where('posts.status',1)
        //     ->where('posts.deleted_at',null)
        //     ->where('posts.expired_at','>=',now())
        //     ->orderBy('posts.id', 'DESC')
        //     ->paginate($limit);

        $type = ($request->has('type'))?$request['type']:null;
        $title =($request->has('title'))?$request['title']:null;
        $limit = ($request->has('limit'))?$request['limit']:10;

        if($type == 1){

            $now = date("Y-m-d");
            $post = Post::where('type',$type)->where('status',1)->where('deleted_at',null)->where('headline','like', '%' .$title. '%')->whereDate('expired_at', '>=',$now)
                    ->when(count($country_id)>0, function($q) use($country_id){return $q->whereIn('country_id',$country_id);})
                    ->when(count($agency_id)>0, function($q) use($agency_id){return $q->whereIn('author_id',$agency_id);})
                    ->when(count($job_id)>0, function($q) use($job_id){return $q->whereIn('job_id',$job_id);})
                    ->orderBy('id','DESC')->paginate($limit);
            // return response(new PostResource($post));
            return PostResource::collection($post);
        }
        elseif($type == 11 || $type == 12 || $type == 13 || $type == 14){
            $post = Post::where('type',$type)->where('status',1)->where('deleted_at',null)->orderBy('id','ASC')->paginate($limit);
            return PostResource::collection($post);
        }
        else{
            $post = Post::where('type',$type)->where('status',1)->where('deleted_at',null)->orderBy('id','DESC')->paginate($limit);
            return PostResource::collection($post);
        }
    }
    public function topPostOwner(){
        $agency =User::where('type',3)->get();
        return AgencyResource::collection($agency);

    }
    public function details($id){
        $post = Post::where('id',$id)->first();
        return new PostResource($post);
    }

    public function post($slug){

        $post = Post::where('id',$slug)->where('deleted_at',null)->first();
         return response()->json([
            'data'  => array(new PostResource($post)),
        ],200);
    }

   public function category()
   {
       $category = Category::whereNull('parent_id')->get();
       return CategoryResource::collection($category);
   }

   public function homeCategory(Request $request)
   {
       $limit     = ($request->has('limit'))?$request['limit']:10;
       $categories = Category::where('home',1)->get();
       $posts = [];
       $i = 0;

       foreach ($categories as $item) {
           $post = Post::select('posts.*')
           ->join('post_categories','post_categories.post_id','=','posts.id')->where('post_categories.category_id', $item->id)
           ->orderBy('posts.id', 'DESC')
            ->paginate($limit);
           $posts[$i] = PostResource::collection($post);
           $i=$i+1;
       }

       return response()->json([
            'categories'  => $categories,
            'posts'        => $posts,
        ],200);
   }




    public function postSection ()
    {
        $section = PostSection::orderBy('id', 'DESC')->get();
        return PostSectionResource::collection($section);
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

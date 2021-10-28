<?php

namespace Modules\Post\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Post\Entities\Post;
use App\JobPostCountry;
use App\JobPostJob;
use App\JobPostLanguage;
use App\SubscribeAgency;
use App\Jobs\SendReminderEmail;
use App\User;


use Modules\Post\Entities\PostCategory;
use Modules\Post\Transformers\Post as PostResource;
use Modules\Post\Transformers\PostCategory as PostCategoryResource;

use Modules\Post\Transformers\PostDetail;

use Modules\Setting\Entities\Ncategory;

use Modules\Setting\Transformers\Ncategory as NcategoryResource;

use Modules\Post\Transformers\ReporterPost;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($type)
    {
        $auth_user_id = Auth()->user()->id;
        if ($type == 1) {
            if (Auth()->user()->type == 1 || Auth()->user()->type == 9) {
                return PostResource::collection(Post::where('type', $type)->where('deleted_at', null)->get());
            } else {
                return PostResource::collection(Post::where('type', $type)->where('author_id', $auth_user_id)->where('deleted_at', null)->get());
            }

        } elseif ($type == 3) {
            if (Auth()->user()->type == 1) {
                return PostResource::collection(Post::where('type', $type)->where('deleted_at', null)->get());
            } else {
                return PostResource::collection(Post::where('type', $type)->where('author_id', $auth_user_id)->where('deleted_at', null)->get());
            }

        } else {
            return PostResource::collection(Post::where('type', $type)->where('deleted_at', null)->get());
        }

    }

    public function postCategory()
    {
        $category = Ncategory::all();
        return NcategoryResource::collection($category);
        return PostResource::collection(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function detail($id)
    {
        $post = Post::findOrfail($id);
        if ($post) {
            return new PostDetail($post);
            // return $post::with('tags','topics','contents','areas','categories')->first();
        }
    }

    public function create(Request $request)
    {
        $auth_user_id = Auth()->user()->id;
        $post = new Post;
        $post->shoulder = $request->shoulder;
        $post->headline = $request->headline;
        $post->hanger = $request->hanger;
        $post->reporter_id = $request->reporter['id'];
        $post->author_id = $auth_user_id;
        $post->content = $request['content'];
        $post->designation = $request->designation;
        $post->expired_at = date('Y-m-d', strtotime($request->expired_at));
        $post->share_at = $request->share_at;
        if ($request->status == 1) {
            $post->published_at = Carbon::now()->toDateTimeString();
        } else {
            $post->published_at = null;
        }
        $post->status = $request->status;
        $post->type = $request->type;
        $post->instant_article = $request->instant_article;

        // featured photo
        $post->featured_image_id = $request->featured_image_id;
        $post->featured_video_id = $request->featured_video_id;

        $post->created_by = $auth_user_id;
        $post->save();
        // tag
        // $post->tags()->attach($request->tag_ids);
        // topic
        // $post->topics()->attach($request->selected_topics);
        // category
        // $post->categories()->attach($request->selected_categories);
        // $post->categories()->attach($request->category_ids);
        // area
        // $post->areas()->attach($request->selected_areas);
        // $post->areas()->attach($request->area_ids);
        // content -> more photo
        $post->contents()->attach($request->content_ids);
        $post->scrolls()->attach($request->selected_scrolls);

        $slug = str_replace(' ', '-', $request->headline);
        $slug = strtolower($slug);
        if (Post::where('slug', $slug)->first()) {
            $post->slug = strtolower($slug . '-' . str_random(5));
        } else {
            $post->slug = $slug;
        }

        if ($request->not_edit_image == 11) {
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'pdf'))
                $extension = 'pdf';
            elseif (str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/images/' . $fileName;
            file_put_contents($path, $decoded);
            $post->image = url('/') . '/images/' . $fileName;
        } else {
            $post->image = $request->image;
        }

        $post->job = $request->job ? json_encode($request->job) : '';
        $post->country = $request->country ? json_encode($request->country) : '';
        $post->language = $request->language ? json_encode($request->language) : '';
        $post->experience = $request->experience;

        $post->job_id = $request->job['id'];
        $post->country_id = $request->country['id'];
        $post->language_id = $request->language['id'];

        $post->experience_required = $request->experience_required;
        $post->job_required = $request->job_required;
        $post->country_required = $request->country_required;
        $post->language_required = $request->language_required;

        if ($post->type == 1) {
            $applicant_id = SubscribeAgency::where('agency_id', $auth_user_id)->get()->pluck('applicant_id');
            $users = User::whereIn('id', $applicant_id)->get();
            foreach ($users as $key => $user) {
                $data = [
                    'user' => $user,
                    'post' => $post
                ];
                SendReminderEmail::dispatch($data)
                    ->delay(now()->addSeconds(20));
            }

        }

        if ($post->save()) {
            return new \Illuminate\Http\Resources\Json\JsonResource($post);
        }
        return 0;
    }


    public function update(Request $request, $id)
    {
        $post = Post::findOrfail($id);
        $auth_user_id = Auth()->user()->id;
        $post->shoulder = $request->shoulder;
        $post->headline = $request->headline;
        $post->hanger = $request->hanger;
        $post->reporter_id = $request->reporter['id'];
        $post->author_id = $auth_user_id;
        $post->content = $request['content'];
        $post->designation = $request->designation;
        $post->expired_at = date('Y-m-d', strtotime($request->expired_at));
        $post->share_at = $request->share_at;
        if ($request->status == 1) {
            $post->published_at = Carbon::now()->toDateTimeString();
        } else {
            $post->published_at = null;
        }
        $post->status = $request->status;
        $post->type = $request->type;
        $post->instant_article = $request->instant_article;

        // featured photo
        $post->featured_image_id = $request->featured_image_id;
        $post->featured_video_id = $request->featured_video_id;

        $post->created_by = $auth_user_id;
        $post->save();
        // tag
        $post->tags()->attach($request->tag_ids);
        // topic
        $post->topics()->attach($request->selected_topics);
        // category
        // $post->categories()->attach($request->selected_categories);
        $post->categories()->attach($request->category_ids);
        // area
        // $post->areas()->attach($request->selected_areas);
        $post->areas()->attach($request->area_ids);
        // content -> more photo
        $post->contents()->attach($request->content_ids);
        $post->scrolls()->attach($request->selected_scrolls);

        if ($request->not_edit_image == 11) {
            $exploded = explode(',', $request->image);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'pdf'))
                $extension = 'pdf';
            elseif (str_contains($exploded[0], 'jpeg'))
                $extension = 'jpg';
            else
                $extension = 'png';

            $fileName = str_random() . '.' . $extension;
            $path = public_path() . '/images/' . $fileName;
            file_put_contents($path, $decoded);
            $post->image = url('/') . '/images/' . $fileName;
        } else {
            $post->image = $request->image;
        }

        $post->job = $request->job ? json_encode($request->job) : '';
        $post->country = $request->country ? json_encode($request->country) : '';
        $post->language = $request->language ? json_encode($request->language) : '';
        $post->experience = $request->experience;

        $post->job_id = $request->job['id'];
        $post->country_id = $request->country['id'];
        $post->language_id = $request->language['id'];

        $post->experience_required = $request->experience_required;
        $post->job_required = $request->job_required;
        $post->country_required = $request->country_required;
        $post->language_required = $request->language_required;

        if ($post->save()) {
            return new PostResource($post);
        }
        return 0;
    }


    public function reporterNews(Request $request)
    {

        $posts = Post::all();
        return ReporterPost::collection($posts);
    }


    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        $post->deleted_at = now();
        if ($post->save()) {
            return new PostResource($post);
        }
    }

    public function updateStatus($id, $status)
    {
        $post = Post::findOrfail($id);
        $post->status = $status;
        $post->published_at = Carbon::now()->toDateTimeString();
        $post->update();
        return new PostResource($post);
    }

    public function search(Request $request)
    {
        $post = Post::where('type', 1)->where('salary','>=',100);
//        dd(($post->get())->toArray());
        if (isset($request->title) && !empty($request->title)) {
            $post = $post->Where('headline', 'LIKe', "%$request->title%");
        }

        if (isset($request->location) && !empty($request->location))
        {
            $post = $post->Where('country_id',$request->location);
        }
        if (isset($request->jobType) && !empty($request->jobType))
        {
            $job = $request->jobType;
            $post = $post->with('jobType')->WhereHas('jobType', function ($app) use ($job) {
                $app->whereIn('id', $job);
            });
        }


        if (isset($request->senior) && !empty($request->senior))
        {
            $kk = $request->senior;
            $post = $post->with('senior')->WhereHas('senior', function ($app) use ($kk) {
                $app->where('id', $kk);
            });
        }

        if (isset($request->gender) && !empty($request->gender))
        {
            $gender = $request->gender;
            $post = $post->with('gender')->WhereHas('gender', function ($app) use ($gender) {
                $app->where('id', $gender);
            });
        }


        $minSalary = $request->minSalary?(int)$request->minSalary:'';
        $maxSalary = $request->maxSalary?(int)$request->maxSalary:'';

        if ((isset($maxSalary) && !empty($maxSalary)) && (isset($minSalary) && !empty($minSalary))) {
            $post = $post->whereBetween('salary', [$minSalary, $maxSalary]);
        }elseif (isset($minSalary) && !empty($minSalary)) {
            $post = $post->where('salary', '>',$minSalary);
        }elseif (isset($maxSalary) && !empty($maxSalary)) {
            $post = $post->where('salary', '<',$maxSalary);
        }
        $post =  $post->toSql();

        return PostResource::collection($post);
    }
}

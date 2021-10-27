<?php

namespace Modules\Post\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use App\User ;
use Carbon\Carbon;
class Post extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $reporter_name =  User::where('id',$this->reporter_id)->first() ;
        $author_name   =  User::where('id',$this->author_id)->first();
        if($reporter_name!=null) $reporter_name = $reporter_name->name;
        if($author_name!=null) $author_name = $author_name->name;

        return [
            'id'=>$this->id,
            'shoulder'=>$this->shoulder,
            'headline'=>$this->headline,
            'designation'=>$this->designation,
            'expired_at'=>$this->expired_at,
            'hanger'=>$this->hanger,
            'author'=>$this->user?$this->user->name:'',
            // 'reporter'=>$this->Reporter->name,
            'content'=>$this->content,
            'featured_image_id'=>$this->featured_image_id,
            // 'FeaturedImage'=>new ContentResource($this->FeaturedImage),
            // 'FeaturedVideo'=>new ContentResource($this->FeaturedVideo),
            // 'PostContents'=> ContentResource::collection($this->PostContent),
            'PostTag' =>$this->PostTag,
            'PostArea' =>$this->PostArea,
            'PostCategory'=>$this->PostCategory,
            'featured_video_id'=>$this->featured_video_id,
            'video_position'=>$this->video_position,
            'share_at'=>$this->share_at,
            'published_at'=> $this->published_at?Carbon::parse($this->published_at)->format('d/m/Y'):"",
            'status'=>$this->status,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'Instant_article'=>$this->Instant_article,
            'job'        => json_decode($this->job),
            'country'    => json_decode($this->country),
            'language'   => json_decode($this->language),
            'experience' => $this->experience,
            'job_id'     => $this->job_id,
            'country_id' => $this->country_id,
            'salary' => $this->salary,
            'language_id'=> $this->language_id,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($this->updated_at)->format('d/m/Y')
        ];

    }
}

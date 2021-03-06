<?php

namespace Modules\FrontEnd\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use App\User ;
use Modules\FrontEnd\Transformers\Content as ContentResource;
use Modules\FrontEnd\Transformers\User as UserResource;
use Modules\FrontEnd\Entities\PostContent;
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
        $PostContent = PostContent::where('post_id',$this->id)->get();
        return [
            'id'=>$this->id,
            'shoulder'=>$this->shoulder,
            'headline'=>$this->headline,
            'designation'=>$this->designation,
            'expired_at'=> $this->expired_at? \Carbon\Carbon::parse($this->expired_at)->format('d/m/Y'):"",
            'type'=>$this->type,
            'hanger'=>$this->hanger,
            // 'athor'=>$this->Author->name,
            // 'reporter'=>$this->Reporter->name,
            'author'=>$this->user?$this->user->name:'',
            'author_slug'=>$this->user?$this->user->slug:'',
            'content'=>$this->content,
            'featured_image_id'=>$this->featured_image_id,
            // 'FeaturedImage'=>new ContentResource($this->FeaturedImage),
            // 'FeaturedVideo'=>new ContentResource($this->FeaturedVideo),
            // 'PostContents'=> ContentResource::collection($this->PostContent),

            'job'        => json_decode($this->job),
            'country'    => json_decode($this->country),
            'language'   => json_decode($this->language),
            'experience' => $this->experience,

            'PostTag' =>$this->PostTag,
            'PostArea' =>$this->PostArea,
            'PostCategory'=>$this->PostCategory,
            'featured_video_id'=>$this->featured_video_id,
            'video_position'=>$this->video_position,
            'share_at'=>$this->share_at,
            'published_at'=> $this->published_at? \Carbon\Carbon::parse($this->published_at)->format('d/m/Y'):"",
            'status'=>$this->status,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'Instant_article'=>$this->Instant_article,
            'updated_by' => $this->updatedBy ? $this->updatedBy->name : "" ,
            'created_by' => $this->createdBy ? $this->createdBy->name : "" ,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('d/m/Y'),
            'updated_at' => $this->updated_at,
        ];
    }
}

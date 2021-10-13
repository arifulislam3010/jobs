<?php

namespace Modules\Post\Entities;

use App\Gender;
use App\JobCategory;
use App\SeniarityLevel;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'shoulder',
        'headline',
        'hanger',
        'author_id',
        'reporter_id',
        'expired_at',
        'content',
        'designation',
        'type',
        'featured_image_id',
        'featured_video_id',
        'video_position',
        'share_at',
        'published_at',
        'status',
        'Instant_article',
        'slug',
        'image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    protected $table = 'posts';

    // tag *
    // topic *
    // category *
    // area *
    // content *
    // scroll
    public function tags(){

        return $this->belongsToMany('Modules\Setting\Entities\Tag','post_tags');
    }
    public function topics(){

        return $this->belongsToMany('Modules\Setting\Entities\Topic','post_topics');
    }

    public function areas(){

        return $this->belongsToMany('Modules\Setting\Entities\Area','post_areas');
    }

    public function categories(){

        return $this->belongsToMany('Modules\Setting\Entities\Category','post_categories');
    }


    public function scrolls(){

        return $this->belongsToMany('Modules\Setting\Entities\Scroll','post_scrolls');
    }


    public function contents(){
        return $this->belongsToMany('Modules\ContentManager\Entities\Content','post_contents');
    }

    public function user(){
        return $this->belongsTo('App\User','author_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function senior()
    {
        return $this->belongsTo(SeniarityLevel::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobCategory::class);
    }
}

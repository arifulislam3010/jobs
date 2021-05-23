<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use App\Contact;
use App\RatingRiview as RatingReviewModel;
use Carbon\Carbon;
class RatingReview extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'                => $this->id,
            'agency_id'         => $this->agency_id,
            'reviewer_id'       => $this->reviewer_id,
            'rating'            => $this->rating,
            'comment'           => $this->comment,
            // 'parent_comment_id' => $this->parent_comment_id,
            'reviewer_image'    => Contact::where('user_id',$this->reviewer_id)->select('image')->get()->first(),
            'reviewer_name'     => User::where('id',$this->reviewer_id)->select('name')->get()->first(),
            'agency_name'     => User::where('id',$this->agency_id)->select('name')->get()->first(),
            'published_at'      => Carbon::parse($this->created_at)->format('d/m/Y'),
            'replies'           => RatingReviewModel::where('parent_comment_id',$this->id)->get()
        ];
    }
}

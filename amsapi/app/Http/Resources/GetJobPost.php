<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class GetJobPost extends JsonResource
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
            'id' => $this->id,
            'headline' =>$this->headline,
            'image' =>$this->image,
            'country' => $this->country_id?DB::table('apps_countries')->where('id',$this->country_id)->select('country_name')->first():'',
            'total'   => DB::table('applyed_applicants')->where('post_id',$this->id)->count(),
            'total_serve'   => DB::table('applyed_applicants')->where('post_id',$this->id)->where('status',4)->count(),
        ];
    }
}

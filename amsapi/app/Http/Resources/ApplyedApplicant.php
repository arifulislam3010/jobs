<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserBasic as UserBasicResource;

class ApplyedApplicant extends JsonResource
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
            'post' =>$this->post?$this->post->headline:'',
            'post_slug' =>$this->post?$this->post->slug:'',
            'agency' =>$this->agency?$this->agency->name:'',
            'agency_slug' =>$this->agency?$this->agency->slug:'',
            'applicant' =>$this->applicant?$this->applicant->name:'',
            'status'=>$this->status,
            'applicant_details'=>$this->applicant?new UserBasicResource($this->applicant):'',
            'agency_details'=>$this->agency?new UserBasicResource($this->agency):'',
        ];
    }
}

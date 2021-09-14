<?php

namespace Modules\FrontEnd\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class AgencyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone' => $this->phone,
            'type'=>$this->type,
            'image' => $this->contact ? url('/').$this->contact->image : "",
            'posts' => $this->Posts,
        ];
    }
}

<?php

namespace Modules\FrontEnd\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class Content extends Resource
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
            'id'        =>$this->id,
            'title'     =>$this->title,
            'file_name' =>config('global.file_path').$this->file_name,
            'type'      =>$this->type
        ];
    }
}

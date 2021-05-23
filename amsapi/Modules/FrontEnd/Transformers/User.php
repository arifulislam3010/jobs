<?php

namespace Modules\FrontEnd\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class User extends ResourceCollection
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
            'contact_id' => $this->contact ? $this->contact->id : null,
            'designation' => $this->contact ? $this->contact->designation : "",
            'father_name' => $this->contact ? $this->contact->father_name : "",
            'mother_name' => $this->contact ? $this->contact->mother_name : "",
            'spouse_name' => $this->contact ? $this->contact->spouse_name : "",
            'area_code' => $this->contact ? $this->contact->area_code : "",
            'mobile_number' => $this->contact ? $this->contact->mobile_number : "",
            'contact_number' => $this->contact ? $this->contact->contact_number : "",
            'occupation' => $this->contact ? $this->contact->occupation : "",
            'nid' => $this->contact ? $this->contact->nid : "",
            'image' => $this->contact ? url('/').$this->contact->image : "",
            'birthday' => $this->contact ? $this->contact->birthday : "",
            'ward_union' => $this->contact ? $this->contact->ward_union: "",
            'area_village' => $this->contact ? $this->contact->area_village : "",
            'street_para' => $this->contact ? $this->contact->street_para : "",
            'post_ofiice' => $this->contact ? $this->contact->post_ofiice : "",
            'company_name' => $this->contact ? $this->contact->company_name : "",
            'agent_id' => $this->contact ? $this->contact->agent_id : "",
            'address' => $this->contact ? json_decode($this->contact->address) : "",
            'country' => $this->contact ? json_decode($this->contact->country_name) : "",
            'website' => $this->contact ? $this->contact->website : "",
            'registration_number' => $this->contact ? $this->contact->registration_number : "",
            // 'district_name' => $this->contact->district ? $this->contact->district->name : "" ,
            // 'district_id' => $this->contact->district ? $this->contact->district->id : null ,
            // 'subdistrict_name' => $this->contact->upazila ? $this->contact->upazila->name : "" ,
            // 'subdistrict_id' => $this->contact->upazila ? $this->contact->upazila->id : null ,
            'agent' => $this->contact ? ($this->contact->agent ? $this->contact->agent->name : "") : "" ,
            'updated_by' => $this->contact ? ($this->contact->updatedBy ? $this->contact->updatedBy->name : "") : "" ,
            'created_by' => $this->contact ? ($this->contact->createdBy ? $this->contact->createdBy->name : "") : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => $this->contact ? $this->contact->image:"",
            'role' => $this->roleUser ? $this->roleUser->role:null,
            'role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'old_role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'role_name' => $this->roleUser ? $this->roleUser->role->name:"",
            
        ];
    }
}

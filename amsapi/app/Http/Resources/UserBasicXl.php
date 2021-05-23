<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserBasicXl extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $permanent_address = $this->contact ? ($this->contact->address2?json_decode($this->contact->address2):""):"";
        $present_address = $this->contact ? ($this->contact->address3?json_decode($this->contact->address3):""):"";
        return [
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'father_name' => $this->contact ? $this->contact->father_name : "",
            'mother_name' => $this->contact ? $this->contact->mother_name : "",
            'spouse_name' => $this->contact ? $this->contact->spouse_name : "",
            'contact_number' => $this->contact ? $this->contact->contact_number : "",
            'nid' => $this->contact ? $this->contact->nid : "",
            'birthday' => $this->contact ? $this->contact->birthday : "",
            'permanent_division' => $permanent_address?$permanent_address->division->division_name_eng:"",
            'permanent_district' => $permanent_address?$permanent_address->district->district_name_eng:"",
            'permanent_subdistrict' => $permanent_address?$permanent_address->subdistrict->upazila_name_eng:"",
            'permanent_union' => $permanent_address?$permanent_address->union->union_name_eng:"",
            'permanent_village' => $permanent_address?$permanent_address->village:"",
            'permanent_street' => $permanent_address?$permanent_address->street:"",
            'permanent_post' => $permanent_address?$permanent_address->postoffice:"",

            'present_division' => $present_address?$present_address->division->division_name_eng:"",
            'present_district' => $present_address?$present_address->district->district_name_eng:"",
            'present_subdistrict' => $present_address?$present_address->subdistrict->upazila_name_eng:"",
            'present_union' => $present_address?$present_address->union->union_name_eng:"",
            'present_village' => $present_address?$present_address->village:"",
            'present_street' => $present_address?$present_address->street:"",
            'present_post' => $present_address?$present_address->postoffice:"",
        ];
    }
}

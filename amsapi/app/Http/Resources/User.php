<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use App\Http\Resources\Recruiting\Visa as VisaResources;
use App\Http\Resources\Recruiting\VisaBasic as VisaBasicResource;
use App\Models\Recruiting\Visa;
use App\RoleUser;
use DB;
use App\Models\Journal\JournalEntry;
use Auth;
class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        
        
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'type'=>$this->type,
            'contact_id' => $this->contact->id,
            'designation' => $this->contact->designation,
            'father_name' => $this->contact->father_name,
            'mother_name' => $this->contact->mother_name,
            'spouse_name' => $this->contact->spouse_name,
            'area_code' => $this->contact->area_code,
            'mobile_number' => $this->contact->mobile_number,
            'contact_number' => $this->contact->contact_number,
            'occupation' => $this->contact->occupation,
            'nid' => $this->contact->nid,
            'image' => $this->contact->image,
            'birthday' => $this->contact->birthday,
            'ward_union' => $this->contact->ward_union,
            'area_village' => $this->contact->area_village,
            'street_para' => $this->contact->street_para,
            'post_ofiice' => $this->contact->post_ofiice,
            'company_name' => $this->contact->company_name,
            'agent_id' => $this->contact->agent_id,
            // 'district_name' => $this->contact->district ? $this->contact->district->name : "" ,
            // 'district_id' => $this->contact->district ? $this->contact->district->id : null ,
            // 'subdistrict_name' => $this->contact->upazila ? $this->contact->upazila->name : "" ,
            // 'subdistrict_id' => $this->contact->upazila ? $this->contact->upazila->id : null ,
            'agent' => $this->contact->agent ? $this->contact->agent->name : "" ,
            'updated_by' => $this->contact->updatedBy ? $this->contact->updatedBy->name : "" ,
            'created_by' => $this->contact->createdBy ? $this->contact->createdBy->name : "" ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'image' => url('/').$this->contact->image,
            'role' => $this->roleUser ? $this->roleUser->role:null,
            'role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'old_role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'role_name' => $this->roleUser ? $this->roleUser->role->name:"",
            
        ];
    }
}

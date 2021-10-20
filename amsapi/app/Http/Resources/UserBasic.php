<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MoneyIn\Invoice;
use App\Models\MoneyIn\PaymentReceive;
use App\Http\Resources\Recruiting\VisaBasic as VisaResources;
use App\Models\Recruiting\Visa;
use DB;
use App\Models\Journal\JournalEntry;

class UserBasic extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $total_invoice  = JournalEntry::Join('visas','journal_entries.visa_id','=','visas.id')
        //          ->whereNotNull('visas.okala_date')->where('visas.status',1)
        //         ->select('journal_entries.*')->where('journal_entries.jurnal_type','invoice')->where('journal_entries.contact_id',$this->id)->sum('journal_entries.amount');
        // $total_receive = JournalEntry::where('jurnal_type','payment_receive')->where('contact_id',$this->id)->sum('amount');
        // if($this->contact->migration_status==1){
        //     $m_status = true;
        // }else{
        //     $m_status = false;
        // }
        // if($this->contact->migration_date!=null){
        //     $m_date = date('Y-m-d', strtotime($this->contact->migration_date));
        // }else{
        //     $m_date ='';
        // }
        $country_id = DB::table('country_applicants')->where('user_id',$this->id)->get()->pluck('country_id');
        $job_id     = DB::table('desired_job_applicants')->where('user_id',$this->id)->get()->pluck('job_id');
        $countries  = DB::table('apps_countries')->whereIn('id',$country_id)->get();
        $jobs       = DB::table('desired_jobs')->whereIn('id',$job_id)->get();
        
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'type'=>$this->type,
            'countries'=>$countries,
            'jobs'=>$jobs,
            'slug'=>$this->slug,
            'permissions'=>$this->permissions,
            // 'migration_status' => $m_status,
            // 'migration_date' => $this->contact ? $m_date : null,
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
            'birthday' => $this->contact ? $this->contact->birthday : "",
            'ward_union' => $this->contact ? $this->contact->ward_union: "",
            'area_village' => $this->contact ? $this->contact->area_village : "",
            'street_para' => $this->contact ? $this->contact->street_para : "",
            'post_ofiice' => $this->contact ? $this->contact->post_ofiice : "",
            'company_name' => $this->contact ? $this->contact->company_name : "",
            'agent_id' => $this->contact ? $this->contact->agent_id : "",
            'address' => $this->contact ? json_decode($this->contact->address) : "",
            'country' => $this->contact ? json_decode($this->contact->country_name) : "",
            'personal' => $this->contact ? json_decode($this->contact->personal) : "",
            'address2' => $this->contact ? json_decode($this->contact->address2) : "",
            'address3' => $this->contact ? json_decode($this->contact->address3) : "",
            'same_address' => $this->contact ? $this->contact->same_address : false,
            'nominee' => $this->contact ? json_decode($this->contact->nominee) : "",
            'educations' => $this->contact ? json_decode($this->contact->educations) : "",
            'languages' => $this->contact ? json_decode($this->contact->languages) : "",
            'experiences' => $this->contact ? json_decode($this->contact->experiences) : "",
            'trainings' => $this->contact ? json_decode($this->contact->trainings) : "",
            'about' => $this->contact ? $this->contact->about : "",
            'website' => $this->contact ? $this->contact->website : "",
            'registration_number' => $this->contact ? $this->contact->registration_number : "",
            'service_name' => $this->contact ? $this->contact->service_name : "",
            'service_url' => $this->contact ? $this->contact->service_url : "",
            'map_link' => $this->contact ? $this->contact->map_link : "",
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
            // 'image' => $this->contact ? url('/').$this->contact->image : "",
            'progress' => $this->contact ? $this->contact->progress:"",
            'personal_status' => $this->contact ? $this->contact->personal_status:"",
            'role' => $this->roleUser ? $this->roleUser->role:null,
            'role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'old_role_id' => $this->roleUser ? $this->roleUser->role->id:null,
            'role_name' => $this->roleUser ? $this->roleUser->role->name:"",
            'training_type' => $this->contact ? $this->contact->type : "",
            'training_type_name' => $this->contact ? ($this->contact->traingType?$this->contact->traingType->name:"") : ""
        ];
    }
}

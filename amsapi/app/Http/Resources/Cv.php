<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;
use App\Experience;
use App\Training;

class Cv extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $country_id = DB::table('country_applicants')->where('user_id',$this->id)->get()->pluck('country_id');
        // $job_id     = DB::table('desired_job_applicants')->where('user_id',$this->id)->get()->pluck('job_id');
        // $countries  = DB::table('apps_countries')->whereIn('id',$country_id)->get();
        // $jobs       = DB::table('desired_jobs')->whereIn('id',$job_id)->get();

        $countries  = '';
        $jobs       = '';

        $total_trainings = Training::join('users','trainings.training_center_id','users.id')->where('trainings.user_id',$this->id)
        ->select('trainings.*','users.name')->get()->count();
        $total_experiences = Experience::where('user_id',$this->id)->get()->count();
        $total = $total_experiences + $total_trainings;
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'countries'=>$countries,
            'jobs'=>$jobs,
            'total'=>$total,
            'mobile_number' => $this->contact ? $this->contact->mobile_number : "",
            'contact_number' => $this->contact ? $this->contact->contact_number : "",
            'nid' => $this->contact ? $this->contact->nid : "",
            'permanent_address' => $this->contact ? json_decode($this->contact->address2) : "",
            'present_address' => $this->contact ? json_decode($this->contact->address3) : "",
            'educations' => $this->contact ? json_decode($this->contact->educations) : "",
            'languages' => $this->contact ? json_decode($this->contact->languages) : "",
            'experiences' => $this->contact ? json_decode($this->contact->experiences) : "",
            'trainings' => $this->contact ? json_decode($this->contact->trainings) : "",
            'image' => $this->contact ? $this->contact->image:"",
        ];
    }
}

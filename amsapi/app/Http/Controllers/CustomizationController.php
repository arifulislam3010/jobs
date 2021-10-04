<?php

namespace App\Http\Controllers;

use App\JobCategory;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    //
    public function getJobType()
    {
        $data = JobCategory::all();
        return ['status'=>true,'data'=>$data];
    }
}

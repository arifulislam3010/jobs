<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complain;
use Validator;

class ComplainController extends Controller
{
    public function index(Request $request){
        // return $request->all();
        // $limit = ($request->has('page'))?$request['page']:null;
        return $complain = Complain::where('type',$request['type'])->orderBy('id', 'desc')->paginate(10);
    }
    public function store(Request $request){
        // return $request->all();
        $rules = array(
            'name'    => 'required',
            'email'   => 'email',
            'phone'   => 'required|digits:11',
            'message' => 'required',
            'type'    => 'required',
        );
        $messsages = array(
           'required' => 'এই ঘরটি পূরণ করা আবশ্যক',
           'digits'   =>'11 ডিজিট হতে হবে',
           'email'    =>'সঠিক ইমেইল দিন',
        );

        $validator = Validator::make($request->all(),$rules,$messsages);
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // $validatedData = $request->validate([
        //     'name'    => 'required',
        //     'email'   => 'email',
        //     'phone'   => 'required|digits:11',
        //     'message' => 'required',
        //     'type'    => 'required',
        // ]);
        $complain = new Complain();
        $complain->type      =   $request->input('type');
        $complain->name      =   $request->input('name');
        $complain->email     =   $request->input('email');
        $complain->phone     =   $request->input('phone');
        $complain->messages  =   $request->input('message');
        $complain->save();
        return $complain; 
    }
}

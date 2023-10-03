<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserContactController extends Controller
{

    //contact page
    public function contactPage(){
        return view('user.contact.list');
    }

    //contact send to admin
    public function contact(Request $request){
        $this->validationData($request);
         $data = $this->contactData($request);
         Contact::create($data);
         return back()->with(['sendSuccess'=>'Successfully Send Message...']);
    }

    //contact data
    private function contactData($request){
        return [
            'name' => $request->name,
            'email' => $request -> email,
            'message' => $request ->message
        ];
    }

    //validation data
    private function validationData($request){
        $validation = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ];
        Validator::make($request->all(),$validation)->validate();
    }
}

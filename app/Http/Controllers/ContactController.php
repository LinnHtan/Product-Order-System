<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function contactList(){
        $contact = Contact::orderBy('created_at','desc')->paginate(4);
        return view('admin.contact.list',compact('contact'));
    }

    public function deleteMessage($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Successfully Delete Message...']);
    }


}


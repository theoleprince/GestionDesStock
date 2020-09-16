<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ContactMail;



class EmailController extends Controller
{

    public function create()
    {
        //return view('contact.create');
    }



    public function store(Request $request){
        
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        Mail::to('josephineme005@gmail.com')->send(new ContactMail());
    }


}
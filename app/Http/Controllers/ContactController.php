<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
 
class ContactController extends Controller
{
    public function create()
    {
        //return view('contact');
    }
 
    public function store(Request $request)
    {
         $data = $request-> validate([
             'name' => 'required',
             'email' => 'required|email',
             'message' => 'required',
         ]);
        Mail::to('alexronelatonzontest@gmail.com')->send(new Contact($data));
 
            return response()->json('200');
    }
}

<?php

namespace App\Http\Controllers\Counsellor\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginControllers extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:191',
            'password' => 'required|max:191|min:8'
        ]);

         if(Auth::guard('counsellor')->attempt($request->only('email','password'))){
            
            return redirect()->back()->with('status','You are Logged in as Admin!');
               
        }else{
             //Authentication failed...
            return redirect()->back()->with('failed','Wrong Credentials');
        }

    }

    public function loginView(){
         return view('counsellors/login');
    }
}

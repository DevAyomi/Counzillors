<?php

namespace App\Http\Controllers\Counsellee\Auth;

use App\Http\Controllers\Controller;
use App\Models\Counsellee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{   
   
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:counsellees,username|max:15',
            'email' => 'required|unique:counsellees,email|max:191|email',
            'password' => 'required|confirmed|min:6',
        ]);

        Counsellee::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => app('hash')->make($request->password),
        ]);

        return redirect()->route('counsellees.profile')->with('success', 'Registered Successfully');

        /*return redirect('counsellees/dashboard')->with('success', 'Registeration Successful')*/;
    }


    /**
     * @param Request $request
     * @param $counselleeId
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerStepTwo(Request $request, $counselleeId)
    {
        $counsellee = Counsellee::find($counselleeId);

        $this->validate($request, [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'dob' => 'required|max:10',
        ]);

        $counsellee->update($request->all());

        return $this->successResponse("Profile Updated Successfully");
    }

     public function viewRegister(){
        return view('counsellees/register');
     }
}

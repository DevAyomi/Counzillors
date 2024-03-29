<?php

namespace App\Http\Controllers\Counsellee\Profile;

use App\Http\Controllers\Controller;
use App\Models\Counsellee;
use App\Models\Counsellor;
use App\Traits\UploadTrait;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use UploadTrait;

    /**
     * Updates a Counsellee's Profile
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:50',
            'lastname' => 'required|max:50',
            'imgpath' => 'required|image',
            'dob' => 'required|max:10'
        ]);

        if ($request->has('imgpath')) {
            $binFile = $request->file('imgpath');
            $folder = '/profile_picture/';
            $name = 'profile_picture' . time();

            $filepath = $folder . $name . '.' . $binFile->getClientOriginalExtension();
            $this->uploadOne($binFile, $folder, 'public', $name);

            Counsellee::findOrFail(auth()->id())
                ->update($request->only(['firstname', 'lastname', 'dob', 'imgpath']));

            return $this->successResponse("Counsellee's Profile updated successfully");
        }
    }

    /**
     * Get a Counsellor's Profile Details
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProfile()
    {
        $counsellee = Counsellee::findOrFail(auth()->id());

       return view('counsellees/profile', compact('counsellee'));
    }

    /**
     * Deactivate/SoftDeletes a Counsellee's account
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivateAccount()
    {
        $counsellee = Counsellee::findOrFail(auth()->id());
        $counsellee->delete();

        return $this->successResponse("Counsellee Deactivated Successfully");
    }

    /**
     * Register a Counsellee as Counsellor Automatically with
     * a specified password and set IDS/relationship on both tables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function registerAsCounsellor(Request $request)
    {
        $this->validate($request, [
           'password' => 'required|max:191|min:8',
        ]);

        $counsellee = Counsellee::findOrFail(auth()->id());

        if($counsellee->is_counsellor) return $this->forbiddenRequestAlert("You are already a Counsellee");

        $counsellor = Counsellor::create(Arr::add(
            $counsellee->toArray(),
            'password', app('hash')->make($request->password)));

        $counsellee->update(['is_counsellor' => $counsellor->id]);
        $counsellor->update(['is_counsellee' => $counsellee->id]);

        return $this->successResponse("Counsellor Switched and Registered as a Counsellee successfully");


    }

    /**
     * Updates a Counsellee's password
     * @param Request $request
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
           'password' => 'required|max:191|min:8'
        ]);

        $counsellor = Counsellee::findOrFail(auth()->id());
        $counsellor->update(['password' => app('hash')->make($request->password)]);

        return $this->successResponse("Password updated successfully");
    }

    public function view(){
        return view('counsellees/edit');
    }
}

<?php

namespace App\Http\Controllers\Personal;

use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected function validationMessages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field max length is :max.',
            'min' => 'The :attribute field min length is :min.',
            'different' => 'The :attribute field must be different with your current password',
            'required_with' => 'The :attribute field must match with :required_with'
        ];
    }

    /**
     * Get a validator.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'password' => 'required',
            'new_password' => 'min:6|different:password',
            'confirm_password' => 'required_with:new_password|min:6'
        ], $this->validationMessages());
    }

    /**
     * Update user personal info
     */
    public function update(Request $request)
    {
        if (!Auth::check()) {
            return redirect('personal/profile')->with('error', 'You are not authorized!');
        }

        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return redirect('personal/profile')->with('errors', $validator->errors());
        }

        $user = User::findOrFail(Auth::id());

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect('personal/profile')->with('error', 'Incorrect password!');
        }

        $user->name = $request->input('name');

        if ($request->input('new_password')) {
            $user->password = bcrypt($request->input('new_password'));
        }

        $user->save();

        return redirect('personal/profile')->with('status', 'The profile information is successfuly updated!');
    }
}
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
    /**
     * Open user edit form
     *
     * @param \Illuminate\Http\Request $request
     */
    public function edit(Request $request)
    {
        $user = $this->getUser();

        return view('personal.profile', [
            'user' => $user
        ]);
    }

    /**
     * Update user personal info
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $validator = $this->getProfileValidator($request->all());

        if ($validator->fails()) {
            return redirect('personal/profile')->with('errors', $validator->errors())->withInput();
        }

        $user = $this->getUser();

        $user->name = $request->input('name');

        $user->save();

        return redirect('personal/profile')->with('status', 'Your personal information has been updated successfuly!');
    }

    /**
     * Update user personal info
     *
     * @param \Illuminate\Http\Request $request
     */
    public function updatePassword(Request $request)
    {
        $validator = $this->getPasswordValidator($request->all());

        if ($validator->fails()) {
            return redirect('personal/profile')->with('errors', $validator->errors());
        }

        $user = $this->getUser();

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect('personal/profile')->with('error', 'Incorrect password!');
        }

        if ($request->input('new_password')) {
            $user->password = bcrypt($request->input('new_password'));
        }

        $user->save();

        return redirect('personal/profile')->with('status', 'Your password has been changed successfully!');
    }

    /**
     * Returns current user object.
     *
     * @return \App\User
     */
    protected function getUser()
    {
        return User::findOrFail(Auth::id());
    }

    /**
     * Define custom validation messages
     * 
     * @return array
     */
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
     * Get personal info validator.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getProfileValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255'
        ], $this->validationMessages());
    }

    /**
     * Get password validator.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getPasswordValidator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required',
            'new_password' => 'min:6|different:password',
            'confirm_password' => 'required_with:new_password|min:6'
        ], $this->validationMessages());
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home', ['users' => User::paginate(10)]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     */
    public function edit(User $user)
    {

        if ($user->name == 'admin' && $user->id == 1) {
            return redirect('/');
        }
        return view('edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param User $user
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     */
    public function delete(User $user)
    {
        if ($user->name == 'admin' && $user->id == 1) {
            return redirect('/');
        }
        return view('delete', ['user'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/')->with('status','User Deleted Successfully');
    }
}

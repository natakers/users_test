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
        return view('home', ['users' => User::getWithPagination()]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     */
    public function edit(User $user)
    {
        return view('edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param string $id
     */
    public function update(UpdateUserRequest $request, $id)
    {
        User::updateUser($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     * @param User $user
     */
    public function delete(User $user)
    {
        return view('delete', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy($id)
    {
        User::deleteUser($id);
    }

    /**
     * Return user.
     * @param string $id
     */
    public function getUser($id)
    {
        return User::getUser($id);
    }

    /**
     * Return next user.
     * @param string $id
     */
    public function nextUser($id)
    {
        return User::getNextUser($id);
    }
}

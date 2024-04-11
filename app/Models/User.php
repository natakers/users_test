<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Requests\UpdateUserRequest;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return paginated users.
     */
    public static function getWithPagination(): LengthAwarePaginator
    {
        return User::paginate(10);
    }

    /**
     * Return updated user.
     * @param UpdateUserRequest $request
     * @param string $id
     */
    public static function updateUser(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->save();
    }

    /**
     * Return user.
     * @param string $id
     */
    public static function getUser($id)
    {
        return User::find($id);
    }

    /**
     * Return next user.
     * @param string $id
     */
    public static function getNextUser($id)
    {
        $user = User::getUser($id);
        return User::where('id', '>', $user->id)->oldest('id')->first();
    }

    /**
     * Delete user.
     * @param string $id
     */
    public static function deleteUser($id)
    {
        $user = User::getUser($id);
        $user->delete();
    }
}

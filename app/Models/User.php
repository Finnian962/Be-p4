<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

#[Fillable(['name', 'email', 'password', 'rolename'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function sp_GetAllUsers($id)
    {
        return DB::select('CALL SP_GetAllUsers(?)', [$id]);
    }

    public function sp_GetUserById($user_Id)
    {
        $result = DB::selectOne('CALL sp_GetUserById(:id)', ['id' => $user_Id]);

        return $result;
    }

    public function sp_GetAllUserroles()
    {
        $result = DB::select('CALL Sp_GetAllUserroles()');

        return $result;
    }

    public function sp_UpdateUser($id, $name, $email, $rolename)
    {
        $result = DB::selectOne('CALL Sp_UpdateUser(:id, :name, :email, :rolename)', [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'rolename' => $rolename,
        ]);

        return $result;
    }

    public function sp_DeleteUser($userId)
    {
        $result = DB::selectOne('CALL sp_DeleteUser(:userId)', [
            'userId' => $userId,
        ]);

        return $result->affected;
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

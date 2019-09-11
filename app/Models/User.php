<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['username', 'email'];

    protected $guarded = ['id', 'password', 'is_admin', 'is_reviewer'];

    public function getRolesArray()
    {
        $roles = [];
        if ($this->is_admin) {
            $roles[] = 'Admin';
        }
        if ($this->is_reviewer) {
            $roles[] = 'Reviewer';
        }

        return $roles;
    }
}

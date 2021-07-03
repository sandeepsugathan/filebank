<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Check if user is an administrator
    *
    * @author Sandeep Sugathan <sandeepsugathan@gmail.com>
    *
    * @return boolean
    */
    public function isAdmin()
    {
        return $this->admin == config('env.user.admin');
    }
}

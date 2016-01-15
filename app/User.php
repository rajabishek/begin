<?php

namespace Begin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the tasks for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function tasks()
    {
        return $this->hasMany('Begin\Task');
    }
}

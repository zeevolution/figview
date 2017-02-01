<?php

namespace Figview\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Return User's IoTEnvs as Member.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function iotenvsMember()
    {
        return $this->belongsToMany(IotEnv::class, 'io_t_env_members', 'member_id', 'iotenv_id');
    }

    /**
     * Return User's IoTEnvs as Owner. 
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function iotenvsOwner()
    {
        return $this->hasMany(IotEnv::class);
    }
}

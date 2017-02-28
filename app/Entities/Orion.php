<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;

class Orion extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port',
        'X_Auth_Token',
        'user_id'
    ];

    /**
     *  The Orion can be part of many IoT Envs.
     */
    public function iotenvs()
    {
        return $this->hasMany(IotEnv::class);
    }

    /**
     * The Orion is created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

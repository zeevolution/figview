<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;

class Idas extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port',
        'user_id'
    ];

    /**
     *  The Idas can be part of many IoT Envs.
     */
    public function iotenvs()
    {
        return $this->hasMany(IotEnv::class);
    }

    /**
     * The Idas is created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

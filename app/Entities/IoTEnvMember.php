<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class IoTEnvMember extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'iotenv_id',
        'member_id'
    ];

    public function iotenv()
    {
        return $this->belongsTo(IotEnv::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class);
    }

}

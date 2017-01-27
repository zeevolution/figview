<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DeviceModel extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'name',
        'model',
        'iotenv_id'
    ];

    public function iotenv()
    {
        return $this->belongsTo(IotEnv::class, 'iotenv_id', 'id');
    }

}

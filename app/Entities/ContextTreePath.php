<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ContextTreePath extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'ancestor',
        'descendant'
    ];

    public function iotEnvAncestor()
    {
        return $this->belongsTo(IotEnv::class, 'ancestor');
    }

    public function iotEnvDescendant()
    {
        return $this->belongsTo(IotEnv::class, 'descendant');
    }

}

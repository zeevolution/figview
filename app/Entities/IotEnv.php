<?php

namespace Figview\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class IotEnv extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'orion_id',
        'idas_id',
        'user_id'
    ];

    /**
     * The IoTEnv has one Orion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orion()
    {
        return $this->belongsTo(Orion::class);
    }

    /**
     * The IoTEnv has one Idas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function idas()
    {
        return $this->belongsTo(Idas::class);
    }

    /**
     * Query the IoTEnv descendants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function queryDescendants()
    {
        return $this->hasMany(ContextTreePath::class, 'ancestor', 'id');
    }

    /**
     * Query the IoTEnv ancestors.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function queryAncestors()
    {
        return $this->hasMany(ContextTreePath::class, 'descendant', 'id');
    }

    /**
     * The IoTEnv is created by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

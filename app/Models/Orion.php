<?php

namespace Figview\Models;

use Illuminate\Database\Eloquent\Model;

class Orion extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port'
    ];
}

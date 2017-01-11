<?php

namespace Figview;

use Illuminate\Database\Eloquent\Model;

class Orion extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port'
    ];
}

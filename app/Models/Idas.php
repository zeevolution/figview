<?php

namespace Figview\Models;

use Illuminate\Database\Eloquent\Model;

class Idas extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port'
    ];
}

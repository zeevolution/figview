<?php

namespace Figview;

use Illuminate\Database\Eloquent\Model;

class Idas extends Model
{
    protected $fillable = [
        'name',
        'url',
        'port'
    ];
}

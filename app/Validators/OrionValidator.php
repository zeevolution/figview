<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 17/01/17
 * Time: 14:57
 */

namespace Figview\Validators;


use Prettus\Validator\LaravelValidator;

class OrionValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'sometimes|required|max:255',
        'url' => 'sometimes|required|URL',
        'port' => 'sometimes|required|max:255'
    ];

}
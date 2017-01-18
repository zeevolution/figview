<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 18/01/17
 * Time: 17:17
 */

namespace Figview\Validators;


use Prettus\Validator\LaravelValidator;

class IdasValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'sometimes|required|max:255',
        'url' => 'sometimes|required|URL',
        'port' => 'sometimes|required|max:255'
    ];

}
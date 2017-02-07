<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 07/02/17
 * Time: 15:05
 */

namespace Figview\Validators;


use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    protected $rules = [
        'name' => 'sometimes|required|max:255',
        'email' => 'sometimes|required|email',
        'password' => 'sometimes|required|max:255'
    ];
}
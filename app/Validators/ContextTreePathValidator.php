<?php

namespace Figview\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ContextTreePathValidator extends LaravelValidator
{

    protected $rules = [
        'ancestor' => 'sometimes|required|integer',
        'descendant' => 'sometimes|required|integer'
   ];
}

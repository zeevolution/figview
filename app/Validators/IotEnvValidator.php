<?php

namespace Figview\Validators;

use \Prettus\Validator\LaravelValidator;

class IotEnvValidator extends LaravelValidator
{

    protected $rules = [
        'orion_id' => 'sometimes|required|integer',
        'idas_id' => 'sometimes|required|integer',
        'user_id' => 'sometimes|required|integer'
   ];
}

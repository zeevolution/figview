<?php

namespace Figview\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class IoTEnvMemberValidator extends LaravelValidator
{

    protected $rules = [
        'iotenv_id' => 'sometimes|required|integer',
        'member_id' => 'sometimes|required|integer',
   ];
}

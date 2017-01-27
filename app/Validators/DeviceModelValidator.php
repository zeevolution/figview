<?php

namespace Figview\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DeviceModelValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'sometimes|required|max:255',
        'model' => 'sometimes|required|JSON',
        'iotenv_id' => 'sometimes|required|integer'
   ];
}

<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 19:37
 */

namespace Figview\Transformers;

use League\Fractal\TransformerAbstract;
use Figview\Entities\IotEnv;

class SimpleIoTEnvTransformer extends TransformerAbstract
{
    public function transform(IotEnv $iotenv)
    {
        return [
            'iotenv_id' => $iotenv->id,
            'iotenv_name' => $iotenv->name
        ];

    }

}
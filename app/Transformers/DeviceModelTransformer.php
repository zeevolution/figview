<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 19:01
 */

namespace Figview\Transformers;

use League\Fractal\TransformerAbstract;
use Figview\Entities\DeviceModel;

class DeviceModelTransformer extends TransformerAbstract
{
    public function transform(DeviceModel $deviceModel)
    {
        return [
            'model_id' => $deviceModel->id,
            'model_name' => $deviceModel->name,
            'model_json' => $deviceModel->model
        ];
    }

}
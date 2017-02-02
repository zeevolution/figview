<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 18:20
 */

namespace Figview\Transformers;

use League\Fractal\TransformerAbstract;
use Figview\Entities\IotEnv;

class IoTEnvTransformer extends TransformerAbstract
{

    /**
     * Default includes of nested data.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'orion',
        'idas',
        'userowner',
        'members',
        'devicemodels',
        'ancestors',
        'descendants'
    ];

    public function transform(IotEnv $iotenv)
    {
        return [
            'id' => $iotenv->id,
            'name' => $iotenv->name,
        ];

    }

    public function includeOrion(IotEnv $iotenv)
    {
        $orion = $iotenv->orion;

        return $this->item($orion, new OrionTransformer);
    }

    public function includeIdas(IotEnv $iotenv)
    {
        $idas = $iotenv->idas;

        return $this->item($idas, new IdasTransformer);
    }

    public function includeUserOwner(IotEnv $iotenv)
    {
        $user = $iotenv->user;

        return $this->item($user, new UserTransformer);
    }

    public function includeMembers(IotEnv $iotenv)
    {
        $members = $iotenv->members;

        return $this->collection($members, new UserTransformer());

    }

    public function includeDeviceModels(IotEnv $iotenv)
    {
        $devicemodels = $iotenv->queryDeviceModels;

        return $this->collection($devicemodels, new DeviceModelTransformer());
    }

    public function includeAncestors(IotEnv $iotenv)
    {
        $ancestors = $iotenv->queryAncestors;

        return $this->collection($ancestors, new ContextTreePathAncestorTransformer());
    }

    public function includeDescendants(IotEnv $iotenv)
    {
        $descendants = $iotenv->queryDescendants;

        return $this->collection($descendants, new ContextTreeDescendantTransformer());
    }


}
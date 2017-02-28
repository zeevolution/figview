<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 15:27
 */

namespace Figview\Transformers;

use Figview\Entities\Orion;
use League\Fractal\TransformerAbstract;

class OrionTransformer extends TransformerAbstract
{

    /**
     * Default includes of nested data.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
        'iotenvs'];

    public function transform(Orion $orion)
    {

        return [
            'orion_id' => $orion->id,
            'orion_name' => $orion->name,
            'orion_url_port' => rtrim($orion->url, "/") . ":" . $orion->port . "/",
            'X_Auth_Token' => $orion->X_Auth_Token,
            'name' => $orion->name,
            'url' => $orion->url,
            'port' => $orion->port
        ];
    }

    public function includeUser(Orion $orion)
    {
        $user = $orion->user;

        return $this->item($user, new OrionUserTransformer);
    }

    public function includeIotenvs(Orion $orion)
    {
        $transformer = new IoTEnvTransformer();
        $transformer->setDefaultIncludes(['idas']);
        $iotenvs = $orion->iotenvs;

        return $this->collection($iotenvs, $transformer);
    }

}
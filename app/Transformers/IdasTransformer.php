<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 16:06
 */

namespace Figview\Transformers;

use Figview\Entities\Idas;
use League\Fractal\TransformerAbstract;

class IdasTransformer extends TransformerAbstract
{
    /**
     * Default includes of nested data.
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user',
        'iotenvs'];

    public function transform(Idas $idas)
    {

        return [
            'idas_id' => $idas->id,
            'idas_name' => $idas->name,
            'idas_url_adminport' => rtrim($idas->url, "/") . ":" . $idas->adminport . "/",
            'idas_url_ul20port' => rtrim($idas->url, "/") . ":" . $idas->ul20port . "/",
            'name' => $idas->name,
            'url' => $idas->url,
            'adminport' => $idas->adminport,
            'ul20port' => $idas->ul20port,
        ];
    }

    public function includeUser(Idas $idas)
    {
        $user = $idas->user;

        return $this->item($user, new IdasUserTransformer);
    }

    public function includeIotenvs(Idas $idas)
    {
        $transformer = new IoTEnvTransformer();
        $transformer->setDefaultIncludes(['orion']);
        $iotenvs = $idas->iotenvs;

        return $this->collection($iotenvs, $transformer);
    }

}
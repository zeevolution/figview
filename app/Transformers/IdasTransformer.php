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
    protected $defaultIncludes = ['user'];

    public function transform(Idas $idas)
    {

        return [
            'idas_id' => $idas->id,
            'idas_name' => $idas->name,
            'idas_url_port' => rtrim($idas->url, "/") . ":" . $idas->port . "/",
        ];
    }

    public function includeUser(Idas $idas)
    {
        $user = $idas->user;

        return $this->item($user, new OrionUserTransformer);
    }

}
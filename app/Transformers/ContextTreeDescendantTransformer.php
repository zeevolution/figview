<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 19:48
 */

namespace Figview\Transformers;

use League\Fractal\TransformerAbstract;
use Figview\Entities\ContextTreePath;

class ContextTreeDescendantTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [
        'iotenvdescendant'
    ];

    public function transform(ContextTreePath $treePath)
    {
        return [
            'descendant' => $treePath->descendant,
        ];
    }

    public function includeIoTEnvDescendant(ContextTreePath $treePath)
    {
        $descendant = $treePath->iotEnvDescendant;

        return $this->item($descendant, new SimpleIoTEnvTransformer());
    }

}
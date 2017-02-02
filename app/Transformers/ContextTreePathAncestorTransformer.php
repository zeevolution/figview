<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 19:20
 */

namespace Figview\Transformers;

use League\Fractal\TransformerAbstract;
use Figview\Entities\ContextTreePath;

class ContextTreePathAncestorTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'iotenvancestor'
    ];

    public function transform(ContextTreePath $treePath)
    {
        return [
            'ancestor' => $treePath->ancestor,
        ];
    }

    public function includeIoTEnvAncestor(ContextTreePath $treePath)
    {
        $ancestor = $treePath->iotEnvAncestor;

        return $this->item($ancestor, new SimpleIoTEnvTransformer());
    }

}
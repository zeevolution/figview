<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 16:25
 */

namespace Figview\Transformers;

use Figview\Entities\User;
use League\Fractal\TransformerAbstract;

class OrionUserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_email' => $user->email,
        ];
    }

}
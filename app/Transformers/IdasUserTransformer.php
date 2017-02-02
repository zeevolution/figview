<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 17:30
 */

namespace Figview\Transformers;


use Figview\Entities\User;
use League\Fractal\TransformerAbstract;

class IdasUserTransformer extends TransformerAbstract
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
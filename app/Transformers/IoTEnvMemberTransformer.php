<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 15/02/17
 * Time: 18:03
 */

namespace Figview\Transformers;


use Figview\Entities\IoTEnvMember;
use League\Fractal\TransformerAbstract;

class IoTEnvMemberTransformer extends TransformerAbstract
{
    /**
     * Default includes of nested data.
     *
     * @var array
     */
    protected $defaultIncludes = ['user'];

    public function transform(IoTEnvMember $ioTEnvMember)
    {
        return [
            'id' => $ioTEnvMember->id, 
            'iotenv_id' => $ioTEnvMember->iotenv_id,
            'member_id' => $ioTEnvMember->member_id
        ];
    }

    public function includeUser(IoTEnvMember $ioTEnvMember)
    {
        $user = $ioTEnvMember->member;

        return $this->item($user, new UserTransformer());
    }




}
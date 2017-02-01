<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 12/01/17
 * Time: 17:04
 */

namespace Figview\Repositories;

use Figview\Entities\Idas;
use Prettus\Repository\Eloquent\BaseRepository;

class IdasRepositoryEloquent extends BaseRepository implements IdasRepository
{
    public function model()
    {
       return Idas::class;
    }

    public function isOwner($idasId, $userId)
    {
        if(count($this->findWhere(['id' => $idasId, 'user_id' => $userId])))
        {
            return true;
        }

        return false;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 12/01/17
 * Time: 16:53
 */

namespace Figview\Repositories;

use Figview\Entities\Orion;
use Prettus\Repository\Eloquent\BaseRepository;

class OrionRepositoryEloquent extends BaseRepository implements OrionRepository
{

    public function model()
    {
        return Orion::class;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 12/01/17
 * Time: 17:18
 */

namespace Figview\Repositories;


use Prettus\Repository\Contracts\RepositoryInterface;

interface IdasRepository extends RepositoryInterface
{

    public function findAllUserIdas($userId, $limit = null, $columns = array());
}
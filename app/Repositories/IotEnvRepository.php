<?php

namespace Figview\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface IotEnvRepository
 * @package namespace Figview\Repositories;
 */
interface IotEnvRepository extends RepositoryInterface
{
    public function findIoTEnvAsOwner($userId, $limit = null, $columns = array());
    public function findIoTEnvAsMember($userId, $limit = null, $columns = array());
}

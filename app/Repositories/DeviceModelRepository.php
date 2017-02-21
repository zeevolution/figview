<?php

namespace Figview\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DeviceModelRepository
 * @package namespace Figview\Repositories;
 */
interface DeviceModelRepository extends RepositoryInterface
{
    public function findAllIotEnvDeviceModels($iotenvId, $limit = null, $columns = array());
}

<?php

namespace Figview\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Figview\Repositories\iotEnvRepository;
use Figview\Entities\IotEnv;
use Figview\Validators\IotEnvValidator;

/**
 * Class IotEnvRepositoryEloquent
 * @package namespace Figview\Repositories;
 */
class IotEnvRepositoryEloquent extends BaseRepository implements IotEnvRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IotEnv::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IotEnvValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

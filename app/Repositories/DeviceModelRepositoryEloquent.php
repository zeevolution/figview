<?php

namespace Figview\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Figview\Repositories\DeviceModelRepository;
use Figview\Entities\DeviceModel;
use Figview\Validators\DeviceModelValidator;

/**
 * Class DeviceModelRepositoryEloquent
 * @package namespace Figview\Repositories;
 */
class DeviceModelRepositoryEloquent extends BaseRepository implements DeviceModelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DeviceModel::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DeviceModelValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

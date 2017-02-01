<?php

namespace Figview\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Figview\Repositories\IoTEnvMemberRepository;
use Figview\Entities\IoTEnvMember;
use Figview\Validators\IoTEnvMemberValidator;

/**
 * Class IoTEnvMemberRepositoryEloquent
 * @package namespace Figview\Repositories;
 */
class IoTEnvMemberRepositoryEloquent extends BaseRepository implements IoTEnvMemberRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return IoTEnvMember::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return IoTEnvMemberValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

<?php

namespace Figview\Repositories;

use Figview\Presenters\IoTEnvPresenter;
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

    /**
     * Check if the user is owner of this IoTEnv resource.
     *
     * @param $iotenvId
     * @param $userId
     * @return bool
     */
    public function isOwner($iotenvId, $userId)
    {
        if(count($this->skipPresenter()->findWhere(['id' =>$iotenvId, 'user_id' => $userId])))
        {
            return true;
        }

        return false;
    }

    /**
     * Check if the user is member of this IoTEnv resource.
     *
     * @param $iotenvId
     * @param $memberId
     * @return bool
     */
    public function hasMember($iotenvId, $memberId)
    {
        $iotenv = $this->skipPresenter()->find($iotenvId);

        foreach ($iotenv->members as $member) {
            if($member->id == $memberId)
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Return the IoTEnv Presenter that identifies the data transformer.
     *
     * @return mixed
     */
    public function presenter()
    {
        return IoTEnvPresenter::class;
    }
}

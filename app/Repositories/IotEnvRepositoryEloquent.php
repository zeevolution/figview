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
     * @var bool
     */
    protected $skipPresenter = false;

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
        $this->skipPresenter = true;
        if(count($this->findWhere(['id' =>$iotenvId, 'user_id' => $userId])))
        {
            $this->skipPresenter = false;
            return true;
        }
        $this->skipPresenter = false;
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
        $this->skipPresenter = true;
        $iotenv = $this->find($iotenvId);
        $this->skipPresenter = false;

        foreach ($iotenv->members as $member) {
            if($member->id == $memberId)
            {
                return true;
            }
        }

        return false;
    }

    public function findIoTEnvsAsOwnerAsMember($userId)
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('iot_envs.*')
                ->leftJoin('io_t_env_members', 'io_t_env_members.iotenv_id', '=', 'iot_envs.id')
                ->where('io_t_env_members.member_id', '=', $userId)
                ->union($this->model->query()->getQuery()->where('user_id', '=', $userId));
        })->all();
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

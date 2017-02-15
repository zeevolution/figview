<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 23/01/17
 * Time: 14:05
 */

namespace Figview\Services;


use Figview\Repositories\IotEnvRepository;
use Figview\Validators\IotEnvValidator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

class IoTEnvService
{
    /**
     * @var IotEnvRepository
     */
    protected $repository;
    /**
     * @var IotEnvValidator
     */
    protected $validator;

    public function __construct(IotEnvRepository $repository, IotEnvValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    public function find($id)
    {
        if($this->checkIoTEnvPermissions($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }
        return $this->repository->find($id);
    }

    public function findWhere($id)
    {
        return $this->repository->findWhere(['user_id' => $id]);
    }

    public function update(array $data, $id)
    {
        if($this->checkIoTEnvOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }

        try{
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    public function delete($id)
    {
        if($this->checkIoTEnvOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }
        $this->repository->delete($id);
    }

    /**
     * Check if the user is owner of the iotEnv.
     *
     * @param $iotEnvId
     * @return mixed
     */
    private function checkIoTEnvOwner($iotEnvId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($iotEnvId, $userId);
    }

    /**
     * Check the user is member of the IoTEnv.
     *
     * @param $iotEnvId
     * @return mixed
     */
    private function checkIoTEnvMember($iotEnvId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($iotEnvId, $userId);
    }

    private function checkIoTEnvPermissions($iotEnvId)
    {
        if($this->checkIoTEnvOwner($iotEnvId) or $this->checkIoTEnvMember($iotEnvId))
        {
            return true;
        }

        return false;
    }
}
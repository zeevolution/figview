<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 27/01/17
 * Time: 17:43
 */

namespace Figview\Services;


use Figview\Repositories\DeviceModelRepository;
use Figview\Validators\DeviceModelValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class DeviceModelService
{

    /**
     * @var DeviceModelRepository
     */
    protected $repository;
    /**
     * @var DeviceModelValidator
     */
    protected $validator;

    public function __construct(DeviceModelRepository $repository, DeviceModelValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function iotenvAllDeviceModels($iotEnvId)
    {
        return $this->repository->findWhere(['iotenv_id' => $iotEnvId]);
    }

    public function iotenvDeviceModel($iotEnvId, $devicemodelId)
    {
        $result =  $this->repository->findWhere(['iotenv_id' => $iotEnvId, 'id' => $devicemodelId]);

        if(isset($result['data']) && count($result['data']) == 1)
        {
            $result = [
                'data' => $result['data'][0]
            ];
        }

        return $result;
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
        return $this->repository->find($id);
    }

    public function update(array $data, $id)
    {
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
        $this->repository->delete($id);
    }
}
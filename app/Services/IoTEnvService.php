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
        return $this->repository->find($id);
    }

    public function findWhere($id)
    {
        return $this->repository->findWhere(['user_id' => $id]);
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
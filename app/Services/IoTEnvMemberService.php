<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 01/02/17
 * Time: 19:23
 */

namespace Figview\Services;


use Figview\Repositories\IoTEnvMemberRepository;
use Figview\Validators\IoTEnvMemberValidator;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

class IoTEnvMemberService
{

    /**
     * @var IoTEnvMemberRepository
     */
    protected $repository;

    /**
     * @var IoTEnvMemberValidator
     */
    protected $validator;

    public function __construct(IoTEnvMemberRepository $repository, IoTEnvMemberValidator $validator)
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

    public function find($idIotEnvMember)
    {
        return $this->repository->find($idIotEnvMember);
    }

    public function findWhere($iotEnvId)
    {
        return $this->repository->findWhere(['iotenv_id' => $iotEnvId]);
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

    public function delete($idIotEnvMember)
    {
        $this->repository->delete($idIotEnvMember);
    }
}
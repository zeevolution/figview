<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 17/01/17
 * Time: 14:42
 */

namespace Figview\Services;


use Figview\Repositories\OrionRepository;
use Figview\Validators\OrionValidator;
use Illuminate\Contracts\Validation\ValidationException;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Validator\Exceptions\ValidatorException;

//Servico utilizado para transacoes, e que pode utilizar repository.

class OrionService
{
    /**
     * @var OrionRepository
     */
    protected $repository;
    /**
     * @var OrionValidator
     */
    protected $validator;

    public function __construct(OrionRepository $repository, OrionValidator $validator)
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
        if($this->checkOrionOwner($id) == false)
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
        if($this->checkOrionOwner($id) == false)
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
        if($this->checkOrionOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }
        $this->repository->delete($id);
    }

    private function checkOrionOwner($orionId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($orionId, $userId);
    }
}
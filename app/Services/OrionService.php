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
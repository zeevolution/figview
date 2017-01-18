<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 18/01/17
 * Time: 17:19
 */

namespace Figview\Services;


use Figview\Repositories\IdasRepository;
use Figview\Validators\IdasValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class IdasService
{

    /**
     * @var IdasRepository
     */
    protected $repository;
    /**
     * @var IdasValidator
     */
    protected $validator;

    public function __construct(IdasRepository $repository, IdasValidator $validator)
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
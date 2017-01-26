<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 25/01/17
 * Time: 15:17
 */

namespace Figview\Services;

use Figview\Repositories\ContextTreePathRepository;
use Figview\Validators\ContextTreePathValidator;
use Prettus\Validator\Exceptions\ValidatorException;

class ContextTreePathService
{
    /**
     * @var ContextTreePathRepository
     */
    protected $repository;
    /**
     * @var ContextTreePathValidator
     */
    protected $validator;

    public function __construct(ContextTreePathRepository $repository, ContextTreePathValidator $validator)
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

    public function find(array $id)
    {
        return $this->repository->findWhere($id, ['*']);
    }

    public function delete(array $id)
    {
        return $this->repository->deleteWhere($id);
    }
}
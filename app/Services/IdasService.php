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
use LucaDegasperi\OAuth2Server\Facades\Authorizer;
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
        if($this->checkIdasOwner($id) == false)
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
        if($this->checkIdasOwner($id) == false)
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
        if($this->checkIdasOwner($id) == false)
        {
            return ['error' => 'Access Forbidden!'];
        }
        $this->repository->delete($id);
    }

    /**
     * Check if the user is owner of the resource.
     *
     * @param $idasId
     * @return mixed
     */
    private function checkIdasOwner($idasId)
    {
        $userId = Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($idasId, $userId);
    }
}
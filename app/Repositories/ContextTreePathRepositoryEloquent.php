<?php

namespace Figview\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Figview\Entities\ContextTreePath;
use Figview\Validators\ContextTreePathValidator;

/**
 * Class ContextTreePathRepositoryEloquent
 * @package namespace Figview\Repositories;
 */
class ContextTreePathRepositoryEloquent extends BaseRepository implements ContextTreePathRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContextTreePath::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        
        return ContextTreePathValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

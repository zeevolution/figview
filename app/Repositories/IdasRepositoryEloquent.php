<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 12/01/17
 * Time: 17:04
 */

namespace Figview\Repositories;

use Figview\Entities\Idas;
use Figview\Presenters\IdasPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class IdasRepositoryEloquent extends BaseRepository implements IdasRepository
{
    protected $fieldSearchable = [
        'name',
        'url',
        'port'
    ];
    
    public function model()
    {
       return Idas::class;
    }

    public function isOwner($idasId, $userId)
    {
        if(count($this->skipPresenter()->findWhere(['id' => $idasId, 'user_id' => $userId])))
        {
            return true;
        }

        return false;
    }

    public function presenter()
    {
        return IdasPresenter::class;
    }

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

}
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
    /**
     * @var bool
     */
    protected $skipPresenter = false;

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
        $this->skipPresenter = true;
        if(count($this->skipPresenter()->findWhere(['id' => $idasId, 'user_id' => $userId])))
        {
            $this->skipPresenter = false;
            return true;
        }

        $this->skipPresenter = false;
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

    public function findAllUserIdas($userId, $limit = 5, $columns = array())
    {
        return $this->scopeQuery(function ($query) use ($userId) {
            return $query->select('idas.*')->where('idas.user_id', '=', $userId);
        })->paginate($limit, $columns);
    }

}
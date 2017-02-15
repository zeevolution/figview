<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 12/01/17
 * Time: 16:53
 */

namespace Figview\Repositories;

use Figview\Entities\Orion;
use Figview\Presenters\OrionPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class OrionRepositoryEloquent extends BaseRepository implements OrionRepository
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
        return Orion::class;
    }

    public function isOwner($orionId, $userId)
    {
        $this->skipPresenter = true;
        if (count($this->skipPresenter()->findWhere(['id' => $orionId, 'user_id' => $userId]))) {
            $this->skipPresenter = false;
            return true;
        }

        $this->skipPresenter = false;
        return false;
    }

    public function presenter()
    {
        return OrionPresenter::class;
    }

    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }

}
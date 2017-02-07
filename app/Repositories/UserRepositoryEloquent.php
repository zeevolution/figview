<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 16:53
 */

namespace Figview\Repositories;


use Figview\Entities\User;
use Figview\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    //public function presenter()
    //{
    //    return UserPresenter::class;
    //}
}
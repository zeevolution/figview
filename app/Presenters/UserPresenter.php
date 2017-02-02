<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 16:29
 */

namespace Figview\Presenters;

use Figview\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class UserPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return UserTransformer::class;
    }

}
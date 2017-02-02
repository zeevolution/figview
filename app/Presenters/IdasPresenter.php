<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 16:13
 */

namespace Figview\Presenters;

use Figview\Transformers\IdasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class IdasPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new IdasTransformer();
    }

}
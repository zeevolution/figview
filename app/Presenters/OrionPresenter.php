<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 15:48
 */

namespace Figview\Presenters;

use Figview\Transformers\OrionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class OrionPresenter extends FractalPresenter
{
    
    public function getTransformer()
    {
        return new OrionTransformer();
    }

}
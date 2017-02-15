<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 15/02/17
 * Time: 18:10
 */

namespace Figview\Presenters;


use Figview\Transformers\IoTEnvMemberTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class IoTEnvMemberPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new IoTEnvMemberTransformer();
    }

}
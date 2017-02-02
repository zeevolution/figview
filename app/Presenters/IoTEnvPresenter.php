<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 02/02/17
 * Time: 18:25
 */

namespace Figview\Presenters;

use Figview\Transformers\IoTEnvTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class IoTEnvPresenter extends FractalPresenter
{

    public function getTransformer()
    {
        return new IoTEnvTransformer();
    }
}
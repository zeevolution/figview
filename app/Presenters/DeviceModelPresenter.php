<?php
/**
 * Created by PhpStorm.
 * User: joseneto
 * Date: 11/02/17
 * Time: 21:35
 */

namespace Figview\Presenters;

use Figview\Transformers\DeviceModelTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class DeviceModelPresenter extends FractalPresenter
{
    public function getTransformer()
    {
        return new DeviceModelTransformer();
    }

}
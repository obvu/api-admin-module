<?php
/**
 * Created by PhpStorm.
 * User: nik
 * Date: 23.04.19
 * Time: 9:23
 */

namespace Obvu\Modules\Api\Admin\submodules\userControl;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class UserControlModule extends Module implements BootstrapInterface
{
    public $userFields;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function bootstrap($app)
    {
        // TODO: Implement bootstrap() method.
    }
}

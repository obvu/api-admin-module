<?php


namespace Obvu\Modules\Api\Admin\submodules\siteInfo\base\modules;


use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class BaseSiteInfoModule extends Module implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $arr = [
            $this->uniqueId.'/publicInfo/pageInfo/locations/<key>' => $this->uniqueId.'/publicInfo/pageInfo/locations/single',
            $this->uniqueId.'/publicInfo/commonInfo' => $this->uniqueId.'/public-info/common-info',
        ];
        $app->urlManager->addRules($arr);
    }
}

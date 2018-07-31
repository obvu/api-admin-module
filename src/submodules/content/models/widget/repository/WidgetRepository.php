<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 13:40
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\widget\repository;

use Obvu\Modules\Api\AdminSubmodules\Content\models\widget\object\WidgetObject;
use Obvu\Modules\Api\AdminSubmodules\Content\models\widget\object\WidgetQuery;
use Zvinger\BaseClasses\app\components\database\repository\BaseRepository;

class WidgetRepository extends BaseRepository
{
    protected static $className = WidgetObject::class;

    private $_widgets_by_key = [];

    public function getWidgetByKey($key, $cacheAllWidgets = TRUE)
    {
        /** @var WidgetQuery $activeQuery */
        $activeQuery = $this->getQuery(NULL);
        if (!$cacheAllWidgets) {
            $this->_widgets_by_key[$key] = $activeQuery->byKey($key)->one();
        } else {
            $widgets = $activeQuery->all();
            foreach ($widgets as $widget) {
                $this->_widgets_by_key[$widget->key] = $widget;
            }
        }

        return $this->_widgets_by_key[$key];
    }
}
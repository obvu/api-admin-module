<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 16:16
 */

namespace Obvu\Modules\Api\Admin\submodules\event\requests\event\create;

use app\components\event\models\create\attributes\EventDateAttribute;
use Obvu\Modules\Api\Admin\submodules\event\responses\event\view\EventViewResponse;

class EventCreateRequest extends EventViewResponse
{
    public $photoId;

    public function init()
    {
        parent::init();
        unset($this->id);
        $newDates = [];
        foreach ($this->dates as $date) {
            $attr = new EventDateAttribute();
            \Yii::configure($attr, (array)$date);
            $newDates[] = $attr;
        }
        $this->dates = $newDates;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 15.08.18
 * Time: 12:19
 */

namespace Obvu\Modules\Api\Admin\models;


use yii\base\Event;

class FilledInformationEvent extends Event
{
    public $filledInformation;

    public $baseInformation;
}
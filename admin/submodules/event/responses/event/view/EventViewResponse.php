<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:33
 */

namespace Obvu\Modules\Api\Admin\submodules\event\responses\event\view;

use app\components\event\models\create\attributes\EventDateAttribute;
use Obvu\Modules\Api\Admin\responses\file\UploadFileResponse;
use yii\base\BaseObject;

/**
 * Class EventViewResponse
 * @package Obvu\Modules\Api\Admin\submodules\event\responses\event\view
 * @SWG\Definition()
 */
class EventViewResponse extends BaseObject
{
    /**
     * Идентификатор мероприятия
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * Название мероприятия
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var string
     * Описание мероприятия
     * @SWG\Property()
     */
    public $description;

    /**
     * Массив дат
     * @var EventDateAttribute[]
     * @SWG\Property()
     */
    public $dates = [];

    /**
     * @var UploadFileResponse
     * @SWG\Property()
     * Фотография
     */
    public $photoData;

    /**
     * @var int
     * @SWG\Property()
     * Идентификатор площадки
     */
    public $locationId;
}
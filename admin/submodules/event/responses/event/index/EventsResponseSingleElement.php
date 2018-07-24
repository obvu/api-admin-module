<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:29
 */

namespace Obvu\Modules\Api\Admin\submodules\event\responses\event\index;

/**
 * @SWG\Definition()
 */
class EventsResponseSingleElement
{
    /**
     * Идентификатор мероприятия
     * @var integer
     * @SWG\Property()
     */
    public $id;

    /**
     * Название
     * @var string
     * @SWG\Property()
     */
    public $eventTitle;

    /**
     * Даты мероприятия
     * @SWG\Property()
     * @var EventIndexDate
     */
    public $eventDate;

    public function __construct()
    {
        $this->eventDate = new EventIndexDate();
    }
}
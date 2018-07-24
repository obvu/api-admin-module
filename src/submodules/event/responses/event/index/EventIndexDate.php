<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.02.18
 * Time: 13:30
 */

namespace Obvu\Modules\Api\Admin\submodules\event\responses\event\index;

/**
 * @SWG\Definition()
 */
class EventIndexDate
{
    /**
     * UnixTimestamp начала мероприятия
     * @var integer
     * @SWG\Property()
     */
    public $start;

    /**
     * UnixTimestamp конца мероприятия
     * @var integer
     * @SWG\Property()
     */
    public $finish;
}
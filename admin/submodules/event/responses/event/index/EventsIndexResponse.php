<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 13:50
 */

namespace Obvu\Modules\Api\Admin\submodules\event\responses\event\index;

/**
 * @SWG\Definition()
 */
class EventsIndexResponse
{
    /**
     * @SWG\Property()
     * @var EventsResponseSingleElement[]
     */
    public $objects = [];
}
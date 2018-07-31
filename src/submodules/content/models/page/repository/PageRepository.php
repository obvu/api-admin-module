<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 13:27
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\page\repository;


use Obvu\Modules\Api\AdminSubmodules\Content\models\page\object\PageObject;
use Zvinger\BaseClasses\app\components\database\repository\BaseRepository;

class PageRepository extends BaseRepository
{
    /**
     * @var string
     */
    protected static $className = PageObject::class;
}
<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 14:05
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\post\repository;


use Obvu\Modules\Api\AdminSubmodules\Content\models\post\object\PostObject;
use Zvinger\BaseClasses\app\components\database\repository\BaseRepository;

class PostRepository extends BaseRepository
{
    protected static $className = PostObject::class;
}
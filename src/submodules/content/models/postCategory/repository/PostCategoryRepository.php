<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 15:12
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\repository;

use Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\object\PostCategory;
use Zvinger\BaseClasses\app\components\database\repository\BaseRepository;

class PostCategoryRepository extends BaseRepository
{
    protected static $className = PostCategory::class;
}
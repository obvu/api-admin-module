<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\response;

use Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\PostCategoryModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\response
 * @SWG\Definition()
 */
class PostCategoryIndexResponse
{
    /**
     * @var PostCategoryModel[]
     * @SWG\Property()
     */
    public $elements;
}
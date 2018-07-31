<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\page\response;

use Obvu\Modules\Api\AdminSubmodules\Content\models\page\PageModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\page\response
 * @SWG\Definition()
 */
class PageIndexResponse
{
    /**
     * @var PageModel[]
     * @SWG\Property()
     */
    public $elements;
}
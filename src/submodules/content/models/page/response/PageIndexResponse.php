<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\AdminSubmodules\content\models\page\response;

use Obvu\Modules\Api\AdminSubmodules\content\models\page\textBlockModel;
use Obvu\Modules\Api\AdminSubmodules\content\models\textBlock\PageModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\AdminSubmodules\content\models\page\response
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
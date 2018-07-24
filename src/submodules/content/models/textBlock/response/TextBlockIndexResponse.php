<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\textBlock\response;

use Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\textBlock\PageModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\textBlock\response
 * @SWG\Definition()
 */
class TextBlockIndexResponse
{
    /**
     * @var PageModel[]
     * @SWG\Property()
     */
    public $elements;
}
<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\response;


use Obvu\Modules\Api\AdminSubmodules\Content\models\page\PageModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\response
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
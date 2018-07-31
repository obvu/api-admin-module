<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\post\response;

use Obvu\Modules\Api\AdminSubmodules\Content\models\post\AdminPostModel;

/**
 * Class PostIndexResponse
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\post\response
 * @SWG\Definition()
 */
class PostIndexResponse
{
    /**
     * @var AdminPostModel[]
     * @SWG\Property()
     */
    public $elements;
}
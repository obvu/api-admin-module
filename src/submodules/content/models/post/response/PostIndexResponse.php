<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:02
 */

namespace Obvu\Modules\Api\Admin\submodules\content\models\post\response;

use Obvu\Modules\Api\Admin\submodules\content\models\post\AdminPostModel;

/**
 * Class PostListResponse
 * @package Obvu\Modules\Api\Admin\submodules\content\models\post\response
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
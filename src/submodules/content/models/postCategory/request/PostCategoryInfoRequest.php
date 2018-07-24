<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:08
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\postCategory\request;


use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class PostInfoRequest
 * @package Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\postCategory\request
 * @SWG\Definition()
 */
class PostCategoryInfoRequest extends BaseApiRequest
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $title;
    /**
     * @var string
     * @SWG\Property()
     */
    public $slug;

    /**
     * @var string
     * @SWG\Property()
     */
    public $description;
}
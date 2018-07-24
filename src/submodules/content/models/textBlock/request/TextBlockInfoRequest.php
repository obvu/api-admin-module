<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:08
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\request;


use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class PostInfoRequest
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\request
 * @SWG\Definition()
 */
class TextBlockInfoRequest extends BaseApiRequest
{
    /**
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var int
     * @SWG\Property()
     */
    public $type;

    /**
     * @var string
     * @SWG\Property()
     */
    public $text;

    /**
     * @var string
     * @SWG\Property()
     */
    public $key;
}
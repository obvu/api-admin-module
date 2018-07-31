<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 13:44
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\page\property;

/**
 * Class TemplateModel
 * @package Obvu\Modules\Api\AdminSubmodules\Content\models\page\property
 * @SWG\Definition()
 */
class TemplateModel
{

    /**
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * @var string
     * @SWG\Property()
     */
    public $title;
}
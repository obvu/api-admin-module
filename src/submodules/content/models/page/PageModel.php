<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:03
 */

namespace Obvu\Modules\Api\AdminSubmodules\content\models\page;

use Obvu\Modules\Api\AdminSubmodules\content\models\page\property\TemplateModel;
use Zvinger\BaseClasses\app\helpers\fakeData\DataFakerGenerator;
use Zvinger\BaseClasses\app\helpers\fakeData\FakeFilledInterface;

/**
 * Class PostModel
 * @package Obvu\Modules\Api\AdminSubmodules\content\models\textBlock
 * @SWG\Definition()
 */
class PageModel
{
    /**
     * @var int
     * @SWG\Property()
     */
    public $id;

    /**
     * @var TemplateModel
     * @SWG\Property()
     */
    public $template;

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
    public $text;
}
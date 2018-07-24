<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:03
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\widget;

use Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\widget\property\TemplateModel;
use Zvinger\BaseClasses\app\helpers\fakeData\DataFakerGenerator;
use Zvinger\BaseClasses\app\helpers\fakeData\FakeFilledInterface;

/**
 * Class PostModel
 * @package Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\textBlock
 * @SWG\Definition()
 */
class WidgetModel
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
    public $key;

    /**
     * @var string
     * @SWG\Property()
     */
    public $value;
}
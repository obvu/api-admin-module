<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 13:26
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\components\page;

use Obvu\Modules\Api\AdminSubmodules\Content\models\page\object\PageObject;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\repository\PageRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\PageModel;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\property\TemplateModel;
use Obvu\Modules\Api\AdminSubmodules\Content\models\page\request\PageInfoRequest;
use Zvinger\BaseClasses\app\components\database\repository\BaseApiRepository;

class ApiAdminPageRepository extends BaseApiRepository
{
    /**
     * ApiAdminPageRepository constructor.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct()
    {
        $this->setRepository(\Yii::createObject(PageRepository::class));
    }

    /**
     * @param PageObject $object
     * @return PageModel
     */
    public function fillApiModelFromObject($object)
    {
        $model = new PageModel();
        $model->id = $object->id;
        $model->slug = $object->slug;
        $model->text = $object->text;
        $model->title = $object->title;
        $templateModel = new TemplateModel();
        $templateModel->id = $object->template_id;
        $templateModel->title = "Template #" . $object->template_id;
        $model->template = $templateModel;

        return $model;
    }

    /**
     * @param PageObject $object
     * @param PageInfoRequest $model
     * @return PageObject
     */
    public function fillObjectFromApiModel($object, $model)
    {
        $object->title = $model->title;
        $object->text = $model->text;
        $object->template_id = $model->templateId;
        $object->slug = $model->slug;

        return $object;
    }
}
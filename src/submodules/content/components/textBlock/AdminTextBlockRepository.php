<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 15:57
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\components\textBlock;

use app\components\database\repository\content\textBlock\models\object\TextBlock;
use app\components\database\repository\content\textBlock\TextBlockRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\request\TextBlockInfoRequest;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\TextBlockModel;
use Zvinger\BaseClasses\app\components\database\repository\BaseApiRepository;

class AdminTextBlockRepository extends BaseApiRepository
{
    /**
     * AdminTextBlockRepository constructor.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct()
    {
        $this->setRepository(\Yii::createObject(TextBlockRepository::class));
    }


    /**
     * @param TextBlock $object
     * @return TextBlockModel
     */
    public function fillApiModelFromObject($object)
    {
        $model = new TextBlockModel();
        $model->id = $object->id;
        $model->title = $object->title;
        $model->text = $object->text;
        $model->type = $object->type;
        $model->key = $object->key;

        return $model;
    }

    /**
     * @param TextBlock $object
     * @param TextBlockInfoRequest $model
     * @return TextBlock
     */
    public function fillObjectFromApiModel($object, $model)
    {
        $object->text = $model->text;
        $object->type = $model->type;
        $object->title = $model->title;
        $object->key = $model->key;

        return $object;
    }
}
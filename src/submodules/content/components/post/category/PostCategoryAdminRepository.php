<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:00
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\components\post\category;


use app\components\database\repository\post\models\category\PostCategory;
use app\components\database\repository\post\PostCategoryRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\postCategory\PostCategoryModel;
use Zvinger\BaseClasses\app\components\database\repository\BaseApiRepository;

class PostCategoryAdminRepository extends BaseApiRepository
{
    public function __construct(
        PostCategoryRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @param PostCategory $object
     * @return PostCategoryModel
     */
    public function fillApiModelFromObject($object)
    {
        $model = $this->createElement();
        $skipKeys = ['postCount'];
        $model->postCount = 10;
        foreach ($model as $key => $value) {
            if (in_array($key, $skipKeys)) {
                continue;
            }
            $model->{$key} = $object->{$key};
        }

        return $model;
    }

    /**
     * @param PostCategory $object
     * @param PostCategoryModel $model
     * @return \yii\db\ActiveRecord
     */
    public function fillObjectFromApiModel($object, $model)
    {
        $skipKeys = ['postCount'];
        foreach ($model as $key => $value) {
            if (in_array($key, $skipKeys)) {
                continue;
            }
            $object->{$key} = $value;
        }

        return $object;
    }

    /**
     * @param bool $fake
     * @return PostCategoryModel
     */
    private function createElement($fake = FALSE)
    {
        $object = new PostCategoryModel();
        if ($fake) {
            $object->fillFakeData();
        }

        return $object;
    }

}
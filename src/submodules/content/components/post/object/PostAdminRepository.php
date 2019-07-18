<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:00
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\components\post\object;

use Obvu\Modules\Api\AdminSubmodules\Content\components\post\category\PostCategoryAdminRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\AdminPostModel;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\object\PostObject;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\repository\PostRepository;
use Obvu\Modules\Api\AdminSubmodules\Content\models\post\request\AdminPostInfoRequest;
use Zvinger\BaseClasses\app\components\database\repository\BaseApiRepository;

class PostAdminRepository extends BaseApiRepository
{
    /**
     * @var PostCategoryAdminRepository
     */
    private $postCategoryAdminRepository;

    /**
     * PostAdminRepository constructor.
     * @param PostRepository $postRepository
     * @param PostCategoryAdminRepository $postCategoryAdminRepository
     */
    public function __construct(
        PostRepository $postRepository,
        PostCategoryAdminRepository $postCategoryAdminRepository
    )
    {
        $this->repository = $postRepository;
        $this->postCategoryAdminRepository = $postCategoryAdminRepository;
    }

    /**
     * @param PostObject $postObject
     * @return AdminPostModel
     */
    public function fillApiModelFromObject($postObject)
    {
        $model = $this->createElement();
        $model->category = $this->postCategoryAdminRepository->getModel($postObject->category_id);
        $model->createdAt = $postObject->created_at;
        $skipKeys = ['category', 'createdAt'];
        foreach ($model as $key => $value) {
            if (in_array($key, $skipKeys)) {
                continue;
            }
            $model->{$key} = $postObject->{$key};
        }

        return $model;
    }

    /**
     * @param PostObject $postObject
     * @param AdminPostInfoRequest $postModel
     * @return PostObject
     */
    public function fillObjectFromApiModel($postObject, $postModel)
    {
        $postObject->category_id = $postModel->categoryId;
        $postObject->created_at = $postModel->createdAt;
        $skipKeys = ['categoryId', 'createdAt'];

        foreach ($postModel as $key => $value) {
            if (in_array($key, $skipKeys)) {
                continue;
            }
            $postObject->{$key} = $value;
        }

        return $postObject;
    }

    /**
     * @return AdminPostModel
     */
    private function createElement()
    {
        return new AdminPostModel();
    }
}

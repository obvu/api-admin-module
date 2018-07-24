<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 0:08
 */

namespace Obvu\Modules\Api\Admin\submodules\content\models\post\request;


use yii\web\BadRequestHttpException;
use Zvinger\BaseClasses\api\request\BaseApiRequest;

/**
 * Class PostInfoRequest
 * @package Obvu\Modules\Api\Admin\submodules\content\models\post\request
 * @SWG\Definition()
 */
class AdminPostInfoRequest extends BaseApiRequest
{
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

    /**
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * @var int
     * @SWG\Property()
     */
    public $categoryId;

    public function validate()
    {
        $result = TRUE;
        if (empty($this->categoryId)) {
            $this->errorMessage = "Категория не может быть пустой";
            $result = FALSE;
        }
        if (empty($this->text)) {
            $this->errorMessage = "Текст не может быть пустым";
            $result = FALSE;
        }
        if (empty($this->title)) {
            $this->errorMessage = "Название не может быть пустым";
            $result = FALSE;
        }

        return $result;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 09.05.18
 * Time: 13:38
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\page\object;

use yii\helpers\ArrayHelper;
use Zvinger\BaseClasses\app\components\data\miscInfo\VendorUserMiscInfoService;

/**
 * Class PageObject
 * @package app\components\database\repository\content\page\models\object
 * @property string text
 * @property array pageData
 */
class PageObject extends DBPageObject
{
    /**
     * @return PageQuery
     */
    public static function find()
    {
        return new PageQuery(static::class);
    }

    public function getMiscInfo()
    {
        return new VendorUserMiscInfoService($this->id, 'page');
    }

    public function setPageData($pageData)
    {
        $this->page_data = json_encode($pageData);
    }

    /**
     * @param null $key
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function getPageData($key = NULL)
    {
        $json_decode = json_decode($this->page_data, 1);
        if ($key !== NULL) {
            return ArrayHelper::getValue($json_decode, $key);
        }

        return $json_decode;
    }

    /**
     * @param $key
     * @param $value
     * @throws \yii\base\InvalidParamException
     */
    public function addPageData($key, $value)
    {
        $data = $this->getPageData();
        $data[$key] = $value;
        $this->setPageData($data);
    }

    /**
     * @param $text
     * @throws \yii\base\InvalidParamException
     */
    public function setText($text)
    {
        $this->addPageData('text', $text);
    }

    /**
     * @return mixed
     * @throws \yii\base\InvalidParamException
     */
    public function getText()
    {
        return $this->getPageData('text');
    }

}

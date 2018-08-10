<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 10.08.18
 * Time: 10:05
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models;

/**
 * Class SingleMenuElement
 * @package Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models
 * @SWG\Definition()
 */
class SingleMenuElement
{
    /**
     * Ключ пункта меню. Для уникальности
     * @var string
     * @SWG\Property()
     */
    public $key;

    /**
     * Название пункта меню
     * @var string
     * @SWG\Property()
     */
    public $title;

    /**
     * Дочерние элементы меню для выпадающего списка
     * @var SingleMenuElement[]
     * @SWG\Property()
     */
    public $children;

    /**
     * Указатель на key из fields. Если стоит null то это просто раскрывающее меню, иначе - переходим на управление этим полем
     * @var string|null
     * @SWG\Property()
     */
    public $block;
}
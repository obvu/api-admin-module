<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 28.05.18
 * Time: 23:44
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\components\settings;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SettingsFormModel;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsFormField;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsModel;

class CrudSettingsRepository
{
    /**
     * @return SingleSettingsModel[]
     * @throws \yii\base\InvalidConfigException
     */
    public function getSettings()
    {
        return [
            \Yii::createObject([
                'class' => SingleSettingsModel::class,
                'title' => 'Площадки',
                'key'   => 'locations',
                'form'  => \Yii::createObject([
                    'class'  => SettingsFormModel::class,
                    'fields' => [
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 1,
                            'type'  => 'input-text',
                            'name'  => 'title',
                            'label' => "Название площадки",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 2,
                            'type'  => 'input-text',
                            'name'  => 'address',
                            'label' => "Адрес",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'textarea',
                            'name'  => 'information',
                            'label' => "Информация",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'file-image',
                            'name'  => 'presentationLinkEvent',
                            'label' => "Презентация мероприятия",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'file-image',
                            'name'  => 'presentationLinkWorkspace',
                            'label' => "Презентация рабочие пространства",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 4,
                            'type'  => 'input-text',
                            'name'  => 'lat',
                            'label' => 'Широта',
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 5,
                            'type'  => 'input-text',
                            'name'  => 'lng',
                            'label' => 'Долгота',
                        ]),
                    ],
                ]),
            ]),
            \Yii::createObject([
                'class' => SingleSettingsModel::class,
                'title' => 'Отзывы',
                'key'   => 'review',
                'form'  => \Yii::createObject([
                    'class'  => SettingsFormModel::class,
                    'fields' => [
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 1,
                            'type'  => 'file-image',
                            'name'  => 'image',
                            'label' => "Фотография",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 2,
                            'type'  => 'input-text',
                            'name'  => 'reviewerTitle',
                            'label' => "Имя",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'input-text',
                            'name'  => 'companyTitle',
                            'label' => "Название компании",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 4,
                            'type'  => 'textarea',
                            'name'  => 'reviewText',
                            'label' => "Комментарий",
                        ]),
                    ],
                ]),
            ]),
            \Yii::createObject([
                'class' => SingleSettingsModel::class,
                'title' => 'Нам доверяют',
                'key'   => 'trusted',
                'form'  => \Yii::createObject([
                    'class'  => SettingsFormModel::class,
                    'fields' => [
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 1,
                            'type'  => 'input-text',
                            'name'  => 'title',
                            'label' => "Название",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 2,
                            'type'  => 'file-image',
                            'name'  => 'image',
                            'label' => "Фотография",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'input-text',
                            'name'  => 'href',
                            'label' => "Ссылка",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 4,
                            'type'  => 'input-text',
                            'name'  => 'width',
                            'label' => "Ширина",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 5,
                            'type'  => 'input-text',
                            'name'  => 'sort',
                            'label' => "Сортировка",
                        ]),
                    ],
                ]),
            ]),
            \Yii::createObject([
                'class' => SingleSettingsModel::class,
                'title' => 'Услуги',
                'key'   => 'service',
                'form'  => \Yii::createObject([
                    'class'  => SettingsFormModel::class,
                    'fields' => [
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 1,
                            'type'  => 'input-text',
                            'name'  => 'title',
                            'label' => "Название",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 2,
                            'type'  => 'file-image',
                            'name'  => 'image',
                            'label' => "Фотография",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'textarea',
                            'name'  => 'text',
                            'label' => "Текст",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 4,
                            'type'  => 'input-text',
                            'name'  => 'buttonText',
                            'label' => "Текст кнопки",
                        ]),
                    ],
                ]),
            ]),
            \Yii::createObject([
                'class' => SingleSettingsModel::class,
                'title' => 'Баннер',
                'key'   => 'banner',
                'form'  => \Yii::createObject([
                    'class'  => SettingsFormModel::class,
                    'fields' => [
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 1,
                            'type'  => 'input-text',
                            'name'  => 'title',
                            'label' => "Название",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 2,
                            'type'  => 'file-image',
                            'name'  => 'image',
                            'label' => "Фотография",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 3,
                            'type'  => 'textarea',
                            'name'  => 'text',
                            'label' => "Текст",
                        ]),
                        \Yii::createObject([
                            'class' => SingleSettingsFormField::class,
                            'id'    => 4,
                            'type'  => 'input-text',
                            'name'  => 'buttonText',
                            'label' => "Текст кнопки",
                        ]),
                    ],
                ]),
            ]),
        ];
    }
}
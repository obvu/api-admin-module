<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 8:14
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud;


use Obvu\Modules\Api\AdminSubmodules\Crud\components\element\ApiCrudElementComponent;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\CrudSettingsRepository;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SettingsFormModel;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsFormField;
use Obvu\Modules\Api\AdminSubmodules\Crud\components\settings\models\SingleSettingsModel;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

/**
 * Class ApiAdminDwyCrudModule
 * @package ObvuCrudModule
 * @property ApiCrudElementComponent $apiElement
 */
class CrudModule extends Module implements BootstrapInterface
{
    public $crudSettings = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        if (empty($this->crudSettings)) {
            $this->crudSettings = [
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
        $this->components = [
            'apiElement'             => ApiCrudElementComponent::class,
            'crudSettingsRepository' => [
                'class'        => CrudSettingsRepository::class,
                'crudSettings' => $this->crudSettings,
            ],
        ];
        parent::init();
    }

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        $app->urlManager->addRules([
            [
                'class'      => 'yii\rest\UrlRule',
                'controller' => $this->uniqueId . '/element',
                'tokens'     => [
                    '{elementType}' => '<elementType>',
                    '{elementId}'   => '<elementId:\\d[\\d,]*>',
                ],
                'patterns'   => [
                    'GET,HEAD {elementType}/{elementId}'  => 'view',
                    'PUT,PATCH {elementType}/{elementId}' => 'update',
                    'GET {elementType}'                   => 'index',
                    'POST {elementType}'                  => 'create',
                    'OPTIONS {elementType}'               => 'options',
                    'OPTIONS {elementType}/{elementId}'   => 'options',
                ],
                'pluralize'  => false,
            ],
        ]);
    }
}
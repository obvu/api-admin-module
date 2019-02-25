<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 06.02.2019
 * Time: 11:04
 */

namespace Obvu\Modules\Api\Admin\submodules\crud\controllers;


use GraphQL\GraphQL;
use Obvu\Modules\Api\Admin\submodules\crud\graphql\schema\Types;
use yii\base\InvalidArgumentException;
use yii\helpers\Json;
use Zvinger\BaseClasses\api\controllers\BaseApiController;

class GraphqlController extends BaseApiController
{
    public $modelClass = '';

    /**
     * @inheritdoc
     */
    protected function verbs()
    {
        return [
            'index' => ['POST'],
        ];
    }

    public function actions()
    {
        return [];
    }

    public function actionIndex()
    {
        // сразу заложим возможность принимать параметры
        // как через MULTIPART, так и через POST/GET

        $query = \Yii::$app->request->get('query', \Yii::$app->request->post('query'));
        $variables = \Yii::$app->request->get('variables', \Yii::$app->request->post('variables'));
        $operation = \Yii::$app->request->get('operation', \Yii::$app->request->post('operation', null));

        if (empty($query)) {
            $rawInput = file_get_contents('php://input');
            $input = json_decode($rawInput, true);
            $query = $input['query'];
            $variables = isset($input['variables']) ? $input['variables'] : [];
            $operation = isset($input['operation']) ? $input['operation'] : null;
        }

        // библиотека принимает в variables либо null, либо ассоциативный массив
        // на строку будет ругаться

        if (!empty($variables) && !is_array($variables)) {
            try {
                $variables = Json::decode($variables);
            } catch (InvalidArgumentException $e) {
                $variables = null;
            }
        }

        // создаем схему и подключаем к ней наши корневые типы

        $schema = new \GraphQL\Type\Schema([
            'query' => Types::query(),
        ]);
        // огонь!

        $result = GraphQL::executeQuery(
            $schema,
            $query,
            null,
            null,
            empty($variables) ? null : $variables,
            empty($operation) ? null : $operation
        )->toArray(YII_DEBUG);

        return $result;
    }
}

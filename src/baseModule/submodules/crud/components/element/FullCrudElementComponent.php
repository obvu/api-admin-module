<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple\SimpleFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListResponse;

class FullCrudElementComponent
{
    public $handlers = [];

    public $module;

    public function listElement(ElementListRequest $request)
    {
        $result = $this->defineHandler($request->type)->getList($request->page, $request->perPage, $request->filter);

        return \Yii::createObject(
            [
                'class' => ElementListResponse::class,
                'elements' => $result->elements,
                'totalCount' => $result->totalCount,
                'headers' => $result->headers,
            ]
        );
    }

    private function defineHandler($type)
    {
        $handlerClass = !empty($this->handlers[$type]) ? $this->handlers[$type] : SimpleFullCrudElementHandler::class;

        /** @var BaseFullCrudElementHandler $handler */
        $handler = \Yii::createObject(
            [
                'class' => $handlerClass,
            ]
        );
        $handler->setType($type);
        $handler->setModule($this->module);

        return $handler;
    }
}

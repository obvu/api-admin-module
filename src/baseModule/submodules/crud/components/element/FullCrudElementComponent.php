<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple\SimpleFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListResponse;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleResponse;

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

    public function singleElement(ElementSingleRequest $request)
    {
        return $this->defineHandler($request->type)->getSingle($request->id);
    }

    public function updateElement(ElementSingleResponse $request)
    {
        return $this->defineHandler($request->element->type)->update($request->element->id, $request->element->fullData);
    }

    public function createElement(ElementSingleResponse $request)
    {
        return $this->defineHandler($request->element->type)->create($request->element->fullData);
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

<?php


namespace Obvu\Modules\Api\Admin\submodules\crud\components\element;


use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\simple\SimpleFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListResponse;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleRequest;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\single\ElementSingleResponse;
use yii\web\NotFoundHttpException;

class FullCrudElementComponent
{
    public $handlers = [];

    public $defaultHandlerClass = SimpleFullCrudElementHandler::class;

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
        try {
            $data = $this->defineHandler($request->type)->getSingle($request->id);
        } catch (NotFoundHttpException $e) {
            if ($request->id == 0) {
                $id = $this->defineHandler($request->type)->getList()->elements[0]->id;
                if (empty($id)) {
                    $data = $this->defineHandler($request->type)->create([])->element;
                } else {
                    $data = $this->defineHandler($request->type)->getSingle($id);
                }
            }
        }

        return $data;

    }

    public function updateElement(ElementSingleResponse $request)
    {
        return $this->defineHandler($request->element->type)->update(
            $request->element->id,
            $request->element->fullData
        );
    }

    public function createElement(ElementSingleResponse $request)
    {
        return $this->defineHandler($request->element->type)->create($request->element->fullData);
    }

    private function defineHandler($type)
    {
        $handlerClass = !empty($this->handlers[$type]) ? $this->handlers[$type] : $this->defaultHandlerClass;

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

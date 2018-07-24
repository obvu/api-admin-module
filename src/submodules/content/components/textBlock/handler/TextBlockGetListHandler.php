<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 15:56
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\components\textBlock\handler;


use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\base\BaseAdminContentRequest;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\base\BaseAdminContentResponse;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\textBlock\index\TextBlockIndexResponse;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\textBlock\index\TextBlockViewResponse;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\interfaces\action\ActionHandlerInterface;

class TextBlockGetListHandler implements ActionHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @return TextBlockIndexResponse
     */
    public function handleAction()
    {
        return new TextBlockIndexResponse();
    }

    /**
     * @param $request
     */
    public function setRequest(BaseAdminContentRequest $request)
    {
        // TODO: Implement setRequest() method.
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        // TODO: Implement validate() method.
    }
}
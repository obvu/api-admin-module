<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 17:06
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\components\textBlock\handler;


use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\base\BaseAdminContentRequest;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\actions\base\BaseAdminContentResponse;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\interfaces\action\ActionHandlerInterface;

class TextBlockUpdateHandler implements ActionHandlerInterface
{
    public function __construct()
    {
    }

    /**
     * @return BaseAdminContentResponse
     */
    public function handleAction()
    {
        return static::class;
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
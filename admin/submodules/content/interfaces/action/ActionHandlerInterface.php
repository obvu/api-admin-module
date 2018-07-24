<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 16:09
 */

namespace Obvu\Modules\Api\Admin\submodules\content\interfaces\action;


use Obvu\Modules\Api\Admin\submodules\content\actions\base\BaseAdminContentRequest;
use Obvu\Modules\Api\Admin\submodules\content\actions\base\BaseAdminContentResponse;

interface ActionHandlerInterface
{
    /**
     * @return BaseAdminContentResponse
     */
    public function handleAction();

    /**
     * @param $request
     */
    public function setRequest(BaseAdminContentRequest $request);

    /**
     * @return bool
     */
    public function validate(): bool;
}
<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:54
 */

namespace Obvu\Modules\Api\Admin\submodules\content\interfaces\textBlock;


use Obvu\Modules\Api\Admin\submodules\content\components\textBlock\filter\TextBlockFilter;
use Obvu\Modules\Api\Admin\submodules\content\models\textBlock\SingleTextBlockModel;

interface TextBlockServiceInterface
{
    /**
     * @param TextBlockFilter $textBlockFilter
     * @return SingleTextBlockModel[]
     */
    public function getTextBlockList(TextBlockFilter $textBlockFilter): array;
}
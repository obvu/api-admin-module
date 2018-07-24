<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:54
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\interfaces\textBlock;


use Obvu\Modules\Api\AdminSubmodules\Content\components\textBlock\filter\TextBlockFilter;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\SingleTextBlockModel;

interface TextBlockServiceInterface
{
    /**
     * @param TextBlockFilter $textBlockFilter
     * @return SingleTextBlockModel[]
     */
    public function getTextBlockList(TextBlockFilter $textBlockFilter): array;
}
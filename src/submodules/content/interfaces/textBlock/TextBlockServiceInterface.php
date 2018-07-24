<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 19.04.18
 * Time: 14:54
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\interfaces\textBlock;


use Obvu\Modules\Api\Admin\AdminSubmodules\Content\components\textBlock\filter\TextBlockFilter;
use Obvu\Modules\Api\Admin\AdminSubmodules\Content\models\textBlock\SingleTextBlockModel;

interface TextBlockServiceInterface
{
    /**
     * @param TextBlockFilter $textBlockFilter
     * @return SingleTextBlockModel[]
     */
    public function getTextBlockList(TextBlockFilter $textBlockFilter): array;
}
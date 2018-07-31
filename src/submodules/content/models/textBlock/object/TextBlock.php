<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.05.18
 * Time: 17:29
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\object;


class TextBlock extends DBTextBlock
{
    public const TYPE_TEXT = 1;
    public const TYPE_HTML = 2;

    public static function find()
    {
        return new TextBlockQuery(static::class);
    }
}
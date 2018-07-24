<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 05.05.18
 * Time: 14:19
 */

namespace Obvu\Modules\Api\Admin\AdminSubmodules\Content\interfaces\blog\post;


interface PostAdminRepositoryInterface
{
    public function getAdminModels(): array;
}
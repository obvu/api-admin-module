<?php
/**
 * Created by PhpStorm.
 * User: amorev
 * Date: 27.11.2018
 * Time: 14:37
 */

namespace Obvu\Modules\Api\AdminSubmodules\Crud\helpers;


abstract class BaseHandler
{
    public $type;

    abstract public function getList($page = 1, $filter = []);

    abstract public function getSingle($id);

    abstract public function create($data);

    abstract public function update($id, $data);

    abstract public function delete($id);
}

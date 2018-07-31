<?php

namespace Obvu\Modules\Api\Admin\repository;

class BaseFilter
{
    public function getFilterArray()
    {
        $filterModelVars = get_object_vars(new static);

        $filterArray = [];
        foreach ($filterModelVars as $name => $value) {
            if (!empty($value)) {
                $filterArray[] = [
                    $name => $value
                ];
            }
        }

        return $filterArray;
    }
}
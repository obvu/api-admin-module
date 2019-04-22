<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\components\filter\special;

use yii\helpers\ArrayHelper;

abstract class BaseSpecialEntityFilter
{
    final public function getType()
    {
        return $this->getCurrentType();
    }

    final public function getConditions($args)
    {
        return $this->getCurrentConditions(ArrayHelper::getValue($args, 'specialFilters'), $args);
    }

    abstract protected function getCurrentType($data = null);

    abstract protected function getCurrentConditions($specialFilters, $arguments = []);

    protected function prepareCompareCondition($format, $key, $value)
    {
        return [
            '$expr' => [
                $format => (array)[
                    ['$toDouble' => '$'.$key],
                    $value,
                ],
            ],
        ];
    }
}

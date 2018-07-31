<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 07.05.18
 * Time: 17:13
 */

namespace Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\repository;

use Obvu\Modules\Api\AdminSubmodules\Content\components\textBlock\filter\TextBlockFilter;
use Obvu\Modules\Api\AdminSubmodules\Content\models\textBlock\object\TextBlock;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use Zvinger\BaseClasses\app\components\database\repository\BaseRepository;

class TextBlockRepository extends BaseRepository
{
    /**
     * @var ActiveRecord
     */
    protected static $className = TextBlock::class;

    /**
     * @param TextBlockFilter $filter
     * @return ActiveQuery
     */
    protected function getQuery($filter): ActiveQuery
    {
        $query = static::$className::find();

        if ($filter !== NULL) {
            if ($filter->key) {
                $query->andWhere(['key' => $filter->key]);
            }
        }

        return $query;
    }
}
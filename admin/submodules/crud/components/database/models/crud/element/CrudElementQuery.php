<?php
/**
 * Created by PhpStorm.
 * User: zvinger
 * Date: 24.05.18
 * Time: 12:20
 */

namespace ObvuCrudModule\components\database\models\crud\element;


use yii\db\ActiveQuery;

/**
 * Class CrudElementQuery
 * @package ObvuCrudModule\components\database\models\crud\element
 * @see CrudElementObject
 */
class CrudElementQuery extends ActiveQuery
{
    public function object($type, $id)
    {
        return $this->andWhere([
            'and',
            ['type' => $type],
            ['data_id' => $id],
        ]);
    }

    public function byType($type)
    {
        return $this->andWhere(['type' => $type]);
    }

    /**
     * @param null $db
     * @return array|null|CrudElementObject
     */
    public function one($db = NULL)
    {
        return parent::one($db); // TODO: Change the autogenerated stub
    }

    /**
     * @param null $db
     * @return array|CrudElementObject[]
     */
    public function all($db = NULL)
    {
        return parent::all($db); // TODO: Change the autogenerated stub
    }


}
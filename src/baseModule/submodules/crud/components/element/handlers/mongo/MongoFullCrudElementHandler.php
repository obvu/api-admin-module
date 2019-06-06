<?php

namespace Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\mongo;

use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\base\BaseFullCrudElementHandler;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementListResult;
use Obvu\Modules\Api\Admin\submodules\crud\components\element\handlers\models\FullCrudElementSingleResult;
use Obvu\Modules\Api\Admin\submodules\crud\models\element\index\ElementListFilter;
use Obvu\Modules\Api\Admin\submodules\crud\models\SingleCrudElementModel;
use yii\mongodb\Connection;
use yii\mongodb\Query;
use yii\web\NotFoundHttpException;

class MongoFullCrudElementHandler extends BaseFullCrudElementHandler
{
    /**
     * @var Connection
     */
    protected $mongo;

    public function __construct(Connection $mongo)
    {
        $this->mongo = $mongo;
    }

    /**
     * @param int $page
     * @param int $perPage
     * @param ElementListFilter|array $filter
     * @return FullCrudElementListResult
     * @throws \yii\base\InvalidConfigException
     */
    public function getList($page = 1, $perPage = 20, $filter = []): FullCrudElementListResult
    {
        $query = $this->getBaseQuery();
        if (is_callable($filter->entityFilterCallback)) {
            call_user_func($filter->entityFilterCallback, [$query, $filter->searchQuery]);
        }
        if ($filter->conditions) {
            $resultConditions = [];
            foreach ($filter->conditions as $condition) {
                $resultCondition = [];
                if (!empty($condition['id'])) {
                    $resultCondition['_id'] = $condition['id'];
                } else {
                    $resultCondition = $condition;
                }
                $resultConditions[] = $resultCondition;
            }
            $query->andWhere($resultConditions);
        }
        if ($filter->orderBy) {
            $query->orderBy($filter->orderBy);
        }
        if ($filter->filterCallBack) {
            ($filter->filterCallBack)($query);
        }
        $provider = $this->getDataProvider($query, $page, $perPage);
        $list = $provider->getModels();
        $result = [];
        foreach ($list as $item) {
            $result[] = $this->convertToData($item)->element;
        }

        return \Yii::createObject(
            [
                'class' => FullCrudElementListResult::class,
                'elements' => $result,
                'totalCount' => $provider->getTotalCount(),
            ]
        );
    }

    /**
     * @param $id
     * @return FullCrudElementSingleResult
     */
    public function getSingle($id)
    {
        $query = $this->getBaseQuery();
        if ($id !== 0) {
            $object = $query->where(['_id' => $id]);
        }
        $object = $query->one();
        if (empty($object)) {
            throw new NotFoundHttpException();
        }

        return $this->convertToData($object);
    }

    public function create($data)
    {
        $id = (string)$this->getCollection()->insert($data);

        return $this->getSingle($id);
    }

    public function update($id, $data)
    {
        $this->getCollection()->update(['_id' => $id], $data);

        return $this->getSingle($id);

    }

    public function delete($id)
    {
        $this->getCollection()->remove(['_id' => $id]);
    }

    private function convertToData($mongoObject)
    {
        $result = $mongoObject;
        $result['id'] = (string)$mongoObject['_id'];
        unset($result['_id']);

        $fullCrudElementSingleResult = \Yii::createObject(
            [
                'class' => FullCrudElementSingleResult::class,
                'element' => \Yii::createObject(
                    [
                        'class' => SingleCrudElementModel::class,
                        'fullData' => $result,
                        'listData' => $result,
                        'id' => $result['id'],
                        'type' => $this->type,
                    ]
                ),
            ]
        );
        $fullCrudElementSingleResult->element->setObject($mongoObject);

        return $fullCrudElementSingleResult;
    }

    /**
     * @return \yii\mongodb\Collection
     */
    private function getCollectionTitle()
    {
        return 'crud_'.$this->module.'_'.$this->type;
    }

    private function getBaseQuery()
    {
        $query = new Query();
        $query
            ->from($this->getCollectionTitle());

        return $query;
    }

    /**
     * @return \yii\mongodb\Collection
     */
    private function getCollection(): \yii\mongodb\Collection
    {
        return $this->mongo->getCollection($this->getCollectionTitle());
    }
}

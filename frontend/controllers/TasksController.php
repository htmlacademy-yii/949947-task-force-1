<?php

namespace frontend\controllers;

use DateInterval;
use DateTime;
use frontend\models\Categories;
use frontend\models\TaskInfo;
use frontend\models\TaskFilter;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;


/**
 * Class TasksController
 *
 * @package frontend\controllers
 */
class TasksController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     * @throws \Exception
     */
    public function actionBrowse()
    {
        $filterModel = new TaskFilter();

        $query = new Query();
        $query->select('*')->from(TaskInfo::tableName() . ' t')->join('JOIN', Categories::tableName() . ' c',
            't.category_id = c.id');
        $filterResult = $_POST;

//        var_dump($filterResult['TaskFilter']);

        if ($filterModel->load(yii::$app->request->post())) {
            if (isset($filterResult['TaskFilter']['categories']) and !empty($filterResult['TaskFilter']['categories'])) {
                foreach ($filterResult['TaskFilter']['categories'] as $categories) {
                    $query->orWhere(['en_name' => $categories]);
                }
            }
            if ($filterResult['TaskFilter']['withoutExecutor']['0'] === 'withoutExecutor') {
                $query->andWhere(['executor_id' => null]);
            }

            if ($filterResult['TaskFilter']['isRemote']['0'] === 'isRemote') {
                $query->andWhere(['longitude' => null])->andWhere(['latitude' => null]);
            }

            if (isset($filterResult['TaskFilter']['period'])) {
                $date = new DateTime();
                $dateCurrent = new DateTime('now');
                $date->sub(new DateInterval("P" . $filterResult['TaskFilter']['period'] . "D"));
                $query->andWhere(['>=', 'dt_add', $date->format('Y-m-d')]);
                $query->andWhere(['<=', 'dt_add', $dateCurrent->format('Y-m-d')]);
            }

            if (!empty($filterResult['TaskFilter']['title']) and isset($filterResult['TaskFilter']['title'])) {
                $query->andWhere(['name' => $filterResult['TaskFilter']['title']]);
            }
        }

        // var_dump($query->prepare(\Yii::$app->db->queryBuilder)->createCommand()->rawSql);

        $taskQuery = $query->all();

        return $this->render('browse', ['tasks' => $taskQuery, 'filter' => $filterModel]);
    }
}


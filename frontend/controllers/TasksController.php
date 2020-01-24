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
        $query->select('*')->from(TaskInfo::tableName() . ' t')->join('JOIN',
            Categories::tableName() . ' c',
            't.category_id = c.id')->orderBy('dt_add DESC');

        if (Yii::$app->request->isPost) {
            $filterModel->tasksFilter($query, Yii::$app->request->post('TaskFilter'));
        }

        $taskQuery = $query->all();

        return $this->render('browse', ['tasks' => $taskQuery, 'filter' => $filterModel]);
    }
}


<?php

namespace frontend\controllers;

use Exception;
use frontend\models\TaskInfo;
use frontend\models\TaskFilter;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


/**
 * Class TasksController
 * @package frontend\controllers
 */
class TasksController extends SecuredController
{

    /**
     * действие для показа страницы списка заданий
     *
     * @return mixed
     * @throws Exception
     */
    public function actionBrowse()
    {
        $filterModel = new TaskFilter();
        if (Yii::$app->request->isPost) {
            $filterModel->load(Yii::$app->request->post());
        }

        $taskQuery = $filterModel->tasksFilter();

        $pages = new Pagination(['totalCount' => $taskQuery->count(), 'pageSize' => 5]);//пагинация
        $model = $taskQuery->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('browse', ['tasks' => $model, 'filter' => $filterModel, 'pages' => $pages]);
    }

    /**
     * Действия для показа подробной информации задания
     *
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $task = TaskInfo::find()->with(['category', 'customer', 'replies.user'])->where(['id' => (int)$id])->one();

        if (!$task) {
            throw new NotFoundHttpException("Страница не найдена!");
        }

        return $this->render('view', ['task' => $task]);
    }
}


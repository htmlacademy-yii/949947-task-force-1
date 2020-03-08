<?php

namespace frontend\controllers;

use DateInterval;
use DateTime;
use frontend\models\Categories;
use frontend\models\Replies;
use frontend\models\TaskInfo;
use frontend\models\TaskFilter;
use frontend\models\Users;
use Yii;
use yii\db\Query;
use yii\helpers\Url;
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
        if (Yii::$app->request->isPost) {
            $filterModel->load(Yii::$app->request->post());
        }
        $taskQuery = $filterModel->tasksFilter();

        return $this->render('browse', ['tasks' => $taskQuery, 'filter' => $filterModel]);
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
//            Yii::$app->response->redirect(Url::to('/404'));//Редикет на 404 страницу
        }

        return $this->render('view', ['task' => $task]);
    }
}


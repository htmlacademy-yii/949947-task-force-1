<?php

namespace frontend\controllers;

use frontend\models\Categories;
use frontend\models\TaskInfo;
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
     */
    public function actionBrowse()
    {
        $tasks = TaskInfo::find()->joinWith('categories')->all();

        return $this->render('browse', ['tasks' => $tasks]);
    }
}

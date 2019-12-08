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
 * Site controller
 */
class TasksController extends Controller
{
    public $data;

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionBrowse()
    {
        $this->data = TaskInfo::find()->joinWith('categories')->asArray()->all();

        return $this->render('browse', ['data' => $this->data]);
    }
}

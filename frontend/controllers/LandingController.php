<?php

namespace frontend\controllers;

use frontend\models\LoginForm;
use Yii;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * контроллер для работы с аутентификацией пользователя
 *
 * Class LandingController
 * @package frontend\controllers
 */
class LandingController extends Controller
{

    /**
     * авторизация пользователя на сайте
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->response->redirect(Url::to('/tasks'));
        }

        $this->layout = 'landing';// устанваливаем новый layout
        $loginForm = new LoginForm();

        if (Yii::$app->request->isPost) {
            $loginForm->load(Yii::$app->request->post());

            if ($loginForm->validate()) {
                $user = $loginForm->getUser();
                Yii::$app->user->login($user);
                Yii::$app->response->redirect(Url::to('/tasks'));
            }
        }

        return $this->render('loginForm', ['loginForm' => $loginForm]);
    }

    /**
     * действие для валидации формы авторизации
     *
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionValidateForm()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                return ActiveForm::validate($model);
            }
        }
        throw new BadRequestHttpException('Bad request!');
    }

    /**
     * Выход из сессии
     *
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }
}

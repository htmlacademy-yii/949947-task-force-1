<?php

namespace frontend\controllers;

use yii\base\Security;
use frontend\models\Users;
use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\widgets\ActiveForm;

/**
 * Контроллер для регистрации
 *
 * Class RegistrationController
 */
class RegistrationController extends Controller
{
    public function actionSignup()
    {
        $this->enableCsrfValidation = false;
        $registration = new Users();

        if (Yii::$app->request->isPost) {
            $registration->load(Yii::$app->request->post());
            if (!$registration->validate()) {
                $errors = $registration->getErrors();
            } else {
                $registration['password'] = Yii::$app->getSecurity()->generatePasswordHash($registration['password']);
                $registration->attributes = $registration;
                $registration->save();
                Yii::$app->response->redirect(Url::to('/tasks'));//здесь редикет на главную
            }
        }
        return $this->render('signup', ['registration' => $registration, 'errors' => $errors]);
    }
}

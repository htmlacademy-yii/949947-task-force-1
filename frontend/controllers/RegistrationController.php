<?php

namespace frontend\controllers;

use frontend\models\RegistrationForm;
use frontend\models\Users;
use Yii;
use yii\base\Exception;
use yii\web\Controller;
use yii\web\Response;

/**
 * Контроллер для регистрации
 *
 * Class RegistrationController
 */
class RegistrationController extends Controller
{
    /**
     * реализует регистрацию пользователя
     *
     * @return string|Response
     * @throws Exception
     */
    public function actionSignup()
    {
        $registration = new RegistrationForm();
        $user = new Users();

        if (Yii::$app->request->isPost) {
            $registration->load(Yii::$app->request->post());
            if (!$registration->validate()) {
                $errors = $registration->getErrors();
            } else {
                $registration['password'] = Yii::$app->getSecurity()->generatePasswordHash($registration['password']);
                $transaction = Yii::$app->db->beginTransaction();
                $user->attributes = $registration->attributes;
                if (!$user->save()) {
                    $transaction->rollBack();
                }
                $transaction->commit();

                return $this->goHome();
            }
        }
        return $this->render('signup', ['registration' => $registration, 'errors' => $errors]);
    }
}

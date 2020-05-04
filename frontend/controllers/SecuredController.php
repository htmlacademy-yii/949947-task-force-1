<?php

namespace frontend\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * контроллер для проверки прав пользователя
 *
 * Class SecuredController
 * @package frontend\controllers
 */
abstract class SecuredController extends Controller
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
}

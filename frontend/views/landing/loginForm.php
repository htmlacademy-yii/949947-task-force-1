<?php

use frontend\models\LoginForm;
use yii\base\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var LoginForm $loginForm
 **/
?>
<section class="modal enter-form form-modal" id="enter-form">
    <h2>Вход на сайт</h2>
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'id' => 'login-form',
        'enableAjaxValidation' => true,
        'method' => 'post',
        'validationUrl' => Url::toRoute('landing/validate-form'),

    ]) ?>
    <p>
        <?= $form->field($loginForm, 'email', [
            'template' => "{label}\n{input}\n{error}",
            'options' => ['tag' => false]
        ])->textInput([
            'class' => 'enter-form-email input input-middle',
            'type' => 'email',
            'id' => 'email',
        ])->label('Email', ['class' => 'form-modal-description', 'for' => 'enter-email'])->error(['tag' => 'span']) ?>
    </p>
    <p>
        <?= $form->field($loginForm, 'password', [
            'template' => "{label}\n{input}\n{error}",
            'options' => ['tag' => false]
        ])->textInput([
            'class' => 'enter-form-email input input-middle',
            'type' => 'password',
            'id' => 'password',
        ])->label('Пароль',
            ['class' => 'form-modal-description', 'for' => 'enter-password'])->error(['tag' => 'span']); ?>
    </p>
    <?= Html::submitButton('Войти', ['class' => 'button']) ?>
    <?php ActiveForm::end(); ?>
    <button class="form-modal-close" type="button">Закрыть</button>
</section>

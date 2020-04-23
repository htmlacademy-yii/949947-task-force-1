<?php

use frontend\models\Cities;
use frontend\models\Users;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/**
 * @var View $this
 * @var Users $registration
 */

?>
<div class="main-container page-container">
    <section class="registration__user">
        <h1>Регистрация аккаунта</h1>
        <div class="registration-wrapper">

            <?php $form = ActiveForm::begin([
                'options' => ['class' => 'registration__user-form form-create'],
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
            ]) ?>
            <?= $form->field($registration, 'email', [
                'template' => "{label}\n{input}",
                'options' => ['tag' => false]
            ])->textInput([
                'class' => 'input textarea',
                'rows' => '1',
                'id' => '16',
                'placeholder' => 'kumarm@mail.ru',
            ])->label('электронная почта', ['class' => $errors['email'][0] ? 'input-danger' : '']) ?>
            <span><?= $errors['email'][0]; ?></span>

            <?= $form->field($registration, 'name_user', [
                'template' => "{label}\n{input}",
                'options' => ['tag' => false]
            ])->textInput([
                'class' => 'input textarea',
                'rows' => '1',
                'id' => '17',
                'placeholder' => 'Мамедов Кумар',
            ])->label('Ваше имя', ['class' => $errors['name_user'][0] ? 'input-danger' : '']) ?>
            <span><?= $errors['name_user'][0]; ?></span>

            <?= $form->field($registration, 'name_city', [
                'template' => "{label}\n{input}",
                'options' => ['tag' => false]
            ])->dropDownList(Cities::getCities(), [
                'class' => 'multiple-select input town-select registration-town',
                'id' => '18',
                'size' => '1',
            ])->label('Город проживания') ?>
            <span>Укажите город, чтобы находить подходящие задачи</span>

            <?= $form->field($registration, 'password', [
                'template' => "{label}\n{input}",
                'options' => ['tag' => false]
            ])->textInput([
                'class' => 'input textarea',
                'type' => 'password',
                'rows' => '1',
                'id' => '19',
            ])->label('Пароль', ['class' => $errors['password'][0] ? 'input-danger' : '']) ?>
            <span><?= $errors['password'][0]; ?></span>

            <?= Html::submitButton('Создать аккаунт', ['class' => 'button button__registration']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </section>
</div>

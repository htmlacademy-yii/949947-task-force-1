<?php

use frontend\components\widgets\DateTimeWidget;

?>
<section class="content-view">
    <div class="content-view__card">
        <div class="content-view__card-wrapper">
            <div class="content-view__header">
                <div class="content-view__headline">
                    <h1><?= $task->name; ?></h1>
                    <span>Размещено в категории
                        <a href="#" class="link-regular"><?= $task->category->name_category; ?></a>
                        <?= DateTimeWidget::widget([
                            'time' => $task->dt_add,
                            'class' => '',
                            'prefix' => 'назад'
                        ]); ?>
                    </span>
                </div>
                <b class="new-task__price new-task__price--clean content-view-price"><?= $task->budget; ?><b>
                        ₽</b></b>
                <div class="new-task__icon new-task__icon--clean content-view-icon"></div>
            </div>
            <div class="content-view__description">
                <h3 class="content-view__h3">Общее описание</h3>
                <p>
                    <?= $task->description; ?>
                </p>
            </div>
            <div class="content-view__attach">
                <h3 class="content-view__h3">Вложения</h3>
                <a href="#">my_picture.jpeg</a>
                <a href="#">agreement.docx</a>
            </div>
            <div class="content-view__location">
                <h3 class="content-view__h3">Расположение</h3>
                <div class="content-view__location-wrapper">
                    <div class="content-view__map">
                        <a href="#"><img src="/img/map.jpg" width="361" height="292"
                                         alt="Москва, Новый арбат, 23 к. 1"></a>
                    </div>
                    <div class="content-view__address">
                        <span class="address__town">Москва</span><br>
                        <span>Новый арбат, 23 к. 1</span>
                        <p>Вход под арку, код домофона 1122</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-view__action-buttons">
            <button class=" button button__big-color response-button open-modal"
                    type="button" data-for="response-form">Откликнуться
            </button>
            <button class="button button__big-color refusal-button open-modal"
                    type="button" data-for="refuse-form">Отказаться
            </button>
            <button class="button button__big-color request-button open-modal"
                    type="button" data-for="complete-form">Завершить
            </button>
        </div>
    </div>
    <div class="content-view__feedback">
        <h2>Отклики <span>(<?= count($task->replies); ?>)</span></h2>
        <div class="content-view__feedback-wrapper">
            <?php foreach ($task->replies as $reply) : ?>
                <div class="content-view__feedback-card">
                    <div class="feedback-card__top">
                        <a href="#"><img src="<?= $reply->user->avatar; ?>>" width="55" height="55"></a>
                        <div class="feedback-card__top--name">
                            <p><a href="#" class="link-regular"><?= $reply->user->name_user; ?></a></p>

                            <?php for ($i = 0; $i < (int)$reply->user->rating; $i++): ?>
                                <span></span>
                            <?php endfor; ?>
                            <?php for ($i = 5 - (int)$reply->user->rating; $i > 0; $i--): ?>
                                <span class="star-disabled"></span>
                            <?php endfor; ?>

                            <b><?= $reply->user->rating; ?></b>
                        </div>
                        <?= DateTimeWidget::widget([
                            'time' => $reply->dt_add_replies,
                            'class' => 'new-task__time',
                            'prefix' => 'назад'
                        ]); ?>
                    </div>
                    <div class="feedback-card__content">
                        <p>
                            <?= $reply->description_replies; ?>
                        </p>
                        <span> <?= $reply->cost; ?>  ₽</span>
                    </div>
                    <div class="feedback-card__actions">
                        <a class="button__small-color request-button button"
                           type="button">Подтвердить</a>
                        <a class="button__small-color refusal-button button"
                           type="button">Отказать</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="connect-desk">
    <div class="connect-desk__profile-mini">
        <div class="profile-mini__wrapper">
            <h3>Заказчик</h3>
            <div class="profile-mini__top">
                <img src="/img/man-brune.jpg" width="62" height="62" alt="Аватар заказчика">
                <div class="profile-mini__name five-stars__rate">
                    <p><?= $task->customer->name_user; ?></p>
                </div>
            </div>
            <p class="info-customer"><span>12 заданий</span>
                <span
                <?= DateTimeWidget::widget([
                    'time' => $task->customer->dt_add_user,
                    'class' => 'last-',
                    'prefix' => 'на сайте'
                ]); ?>
            </p>
            <a href="#" class="link-regular">Смотреть профиль</a>
        </div>
    </div>
    <div class="connect-desk__chat">
        <h3>Переписка</h3>
        <div class="chat__overflow">
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:56</p>
                <p class="chat__message-text">Привет. Во сколько сможешь
                    приступить к работе?</p>
            </div>
            <div class="chat__message chat__message--in">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">На задание
                    выделены всего сутки, так что через час</p>
            </div>
            <div class="chat__message chat__message--out">
                <p class="chat__message-time">10.05.2019, 14:57</p>
                <p class="chat__message-text">Хорошо. Думаю, мы справимся</p>
            </div>
        </div>
        <p class="chat__your-message">Ваше сообщение</p>
        <form class="chat__form">
            <textarea class="input textarea textarea-chat" rows="2" name="message-text"
                      placeholder="Текст сообщения"></textarea>
            <button class="button chat__button" type="submit">Отправить</button>
        </form>
    </div>
</section>

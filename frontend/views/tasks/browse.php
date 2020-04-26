<?php

use frontend\components\widgets\DateTimeWidget;
use frontend\models\Categories;
use frontend\models\TaskInfo;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use frontend\models\TaskFilter;
use yii\helpers\Html;
use yii\widgets\LinkPager;

/**
 * @var View $this
 * @var TaskInfo[] $tasks
 * @var TaskInfo $pages
 * @var TaskInfo $filter
 */

$this->title = 'TaskForce';
?>
<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php foreach ($tasks as $item) : ?>
            <div class="new-task__card">
                <div class="new-task__title">
                    <a href="<?= Url::to(['view', 'id' => $item->id]); ?>" class="link-regular">
                        <h2><?= $item->name; ?></h2></a>
                    <a class="new-task__type link-regular" href="#"><p><?= $item->category->name_category; ?></p>
                    </a>
                </div>
                <div class="new-task__icon new-task__icon--translation"></div>
                <p class="new-task_description">
                    <?= $item['description']; ?>
                </p>
                <b class="new-task__price new-task__price--translation"><?= $item->budget; ?><b> ₽</b></b>
                <p class="new-task__place"><?= $item->address; ?></p>
                <?= DateTimeWidget::widget([
                    'time' => $item->dt_add,
                    'class' => 'new-task__time',
                    'prefix' => 'назад'
                ]); ?>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="new-task__pagination">
        <?= LinkPager::widget([
            'pagination' => $pages,
            'options' => [
                'class' => 'new-task__pagination-list',
            ],
            'activePageCssClass' => 'pagination__item--current',
            'pageCssClass' => 'pagination__item',
            'prevPageCssClass' => 'pagination__item',
            'nextPageCssClass' => 'pagination__item',
            'nextPageLabel' => '⠀',
            'prevPageLabel' => '⠀',
            'hideOnSinglePage' => true
        ]) ?>
    </div>
</section>
<section class="search-task">
    <div class="search-task__wrapper">
        <?php $form = ActiveForm::begin(['options' => ['class' => 'search-task__form']]); ?>
        <fieldset class="search-task__categories">
            <legend>Категории</legend>

            <?= $form->field($filter, 'category')
                ->checkboxList(Categories::getCategoriesList(), [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $id = "{$index}";
                        return Html::checkbox($name, $checked,
                                [
                                    'id' => $id,
                                    'class' => 'visually-hidden checkbox__input',
                                    'value' => $value
                                ]) . Html::label($label, $id);
                    }
                ])->label(false); ?>

        </fieldset>
        <fieldset class="search-task__categories">
            <legend>Дополнительно</legend>

            <?= $form->field($filter, 'withoutExecutor')
                ->checkboxList(['withoutExecutor' => 'Без исполнителя'], [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return Html::checkbox($name, $checked,
                                [
                                    'id' => 10,
                                    'class' => 'visually-hidden checkbox__input',
                                    'value' => $value
                                ]) . Html::label($label, 10);
                    }
                ])->label(false); ?>

            <?= $form->field($filter, 'isRemote')
                ->checkboxList(['isRemote' => 'Удаленная работа'], [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        return Html::checkbox($name, $checked,
                                [
                                    'id' => 11,
                                    'class' => 'visually-hidden checkbox__input',
                                    'value' => $value
                                ]) . Html::label($label, 11);
                    }
                ])->label(false); ?>
        </fieldset>
        <?= $form->field($filter, 'period', [
            'template' => "{label}\n{input}",
            'options' => ['tag' => false]
        ])->dropDownList(TaskFilter::getPeriodList(),
            ['class' => 'multiple-select input']
        )->label('Период', ['class' => 'search-task__name']);

        echo $form->field($filter, 'title', [
            'template' => "{label}\n{input}",
            'options' => ['tag' => false]
        ])
            ->textInput(['class' => 'input-middle input'])
            ->label('Поиск по названию', ['class' => 'search-task__name']); ?>

        <?= Html::submitButton('Искать', ['class' => 'button']) ?>

        <?php ActiveForm::end(); ?>
    </div>
</section>

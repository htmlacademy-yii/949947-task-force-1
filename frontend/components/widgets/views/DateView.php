<?php

namespace frontend\components\widgets\views;

use frontend\helpers\PluralForm;

?>
<span class="<?= $class ?>">
<?php if ($diff->y): ?>
    <?= $diff->y ?> <?= PluralForm::dateForm($diff->y, 'год', 'года', 'лет') ?>
<?php endif; ?>
<?php if ($diff->m): ?>
    <?= $diff->m ?> <?= PluralForm::dateForm($diff->m, 'месяц', 'месяца', 'месяцев') ?>
<?php endif; ?>
<?php if ($diff->d): ?>
    <?= $diff->d ?> <?= PluralForm::dateForm($diff->d, 'день', 'дня', 'дней') ?>
<?php endif; ?>
<?php if ($diff->h): ?>
    <?= $diff->h ?> <?= PluralForm::dateForm($diff->h, 'час', 'часа', 'часов') ?>
<?php endif; ?>
<?php if ($diff->i): ?>
    <?= $diff->i ?> <?= PluralForm::dateForm($diff->i, 'минута', 'минуты', 'минут') ?>
<?php endif; ?>
<?= ' ' . $prefix ?></span>

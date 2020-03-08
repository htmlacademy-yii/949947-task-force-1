<?php

namespace frontend\components\widgets;

use DateTime;
use Exception;
use frontend\helpers\PluralForm;
use yii\base\Widget;

/**
 * Виджет для работы с относительным временем
 *
 * Class DateTimeWidget
 * @package frontend\components\widgets
 */
class DateTimeWidget extends Widget
{
    public $time;
    public $class;
    public $prefix;

    /**
     * Функция переводить время из dateTime формата в относительный
     *
     * @return string
     * @throws Exception
     */
    public function run()
    {
        $addDateTime = new DateTime($this->time);
        $diff = $addDateTime->diff(new DateTime());
        if ($diff->y > 0) {
            return $this->render('DateView', [
                'time' => floor($diff->y),
                'name' => PluralForm::dateForm(floor($diff->y), 'год', 'года', 'лет'),
                'class' => $this->class,
                'prefix' => $this->prefix,
            ]);
        } elseif ($diff->m > 0 && $diff->m <= 12) {
            return $this->render('DateView', [
                'time' => floor($diff->m),
                'name' => PluralForm::dateForm(floor($diff->m), 'месяц', 'месяца', 'месяцев'),
                'class' => $this->class,
                'prefix' => $this->prefix,
            ]);
        } elseif ($diff->d > 0 && $diff->d <= 30) {
            return $this->render('DateView', [
                'time' => floor($diff->d),
                'name' => PluralForm::dateForm(floor($diff->m), 'день', 'дня', 'дней'),
                'class' => $this->class,
                'prefix' => $this->prefix,
            ]);
        } else {
            return $this->render('DateView', [
                'time' => floor($diff->i),
                'name' => PluralForm::dateForm(floor($diff->m), 'минута', 'минуты', 'минут'),
                'class' => $this->class,
                'prefix' => $this->prefix,
            ]);
        }

    }
}


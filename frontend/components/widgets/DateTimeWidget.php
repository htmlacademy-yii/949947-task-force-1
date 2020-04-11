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

        return $this->render('DateView', [
            'diff' => $diff,
            'class' => $this->class,
            'prefix' => $this->prefix,
        ]);
    }
}


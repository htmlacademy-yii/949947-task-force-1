<?php

namespace frontend\helpers;

class PluralForm
{
    /**
     * Функция возвращает обозначения времени с учетом падежей(день,дней,дня)
     *
     * @param $time
     * @param $option1
     * @param $option2
     * @param $option3
     * @return mixed
     */
    public static function dateForm(float $time, string $option1, string $option2, string $option3)
    {
        if (($time % 10) === 1) {
            return $option1;
        } elseif (($time % 10) > 1 && ($time % 10) < 5) {
            return $option2;
        } else {
            return $option3;
        }
    }
}

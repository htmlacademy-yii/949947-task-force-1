<?php

namespace frontend\helpers;

/**
 * Class DateHelper
 * Вспомогательный класс для работы с датой и временем
 *
 * @package frontend\helpers
 */
class DateHelper
{
    /**
     * Выводит время в относительном формате
     * 
     * @param string $dateAdd
     * @return float
     */
    public static function transferDate(string $dateAdd)
    {
        $dateInSecond = (time() - strtotime($dateAdd));//дата в секундах

        if (($dateInSecond / 60) < 60) {
            return floor($dateInSecond / 60) . ' минут';
        } elseif (($dateInSecond / 3600) < 60) {
            return floor($dateInSecond / 3600) . ' часов';
        } else {
            return floor($dateInSecond / (3600 * 24)) . ' дней';
        }
    }
}

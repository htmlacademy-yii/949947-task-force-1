<?php

namespace frontend\helpers;

/**
 * Class DateHelper
 * Вспомогательный класс для работы с датой и врвменем
 *
 * @package frontend\helpers
 */
class DateHelper
{
    /**
     * @param string $dateAdd
     * @return float
     */
    public static function transferHours(string $dateAdd)
    {
        return ceil((time() - strtotime($dateAdd)) / 3600);
    }
}

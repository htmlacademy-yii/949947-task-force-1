<?php

namespace frontend\helpers;

class DateHelper
{
    public static function transferHours($date_add)
    {
        return ceil((time() - strtotime($date_add)) / (3600));
    }
}
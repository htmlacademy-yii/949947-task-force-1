<?php

namespace frontend\models;

use yii\base\Model;

class TaskFilter extends Model
{

    const PERIOD_DAY = '1';
    const PERIOD_WEEK = '7';
    const PERIOD_MONTH = '30';

    public $categories;
    public $withoutExecutor;
    public $isRemote;
    public $period;
    public $title;

    /**
     * @return array
     */
    public static function AttributeLabel()
    {
        return
            [
                'categories' => 'категории',
                'withoutExecutor' => 'без исполителя',
                'isRemote' => 'Удаленная работа',
                'period' => 'Период',
                'title' => 'название',
            ];
    }

    /**
     * @return array
     */
    public static function getPeriodList()
    {
        return [
            self::PERIOD_DAY => 'День',
            self::PERIOD_WEEK => 'Неделя',
            self::PERIOD_MONTH => 'Месяц',
        ];
    }
}

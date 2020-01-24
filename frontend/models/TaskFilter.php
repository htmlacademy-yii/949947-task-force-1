<?php

namespace frontend\models;

use DateInterval;
use DateTime;
use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;

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

    public function tasksFilter($query, $filterResult)
    {
        if (isset($filterResult['categories']) and !empty($filterResult['categories'])) {
            foreach ($filterResult['categories'] as $categories) {
                $query->orWhere(['en_name' => $categories]);
            }
        }
        if ($filterResult['withoutExecutor']['0'] === 'withoutExecutor') {
            $query->andWhere(['executor_id' => null]);
        }

        if ($filterResult['isRemote']['0'] === 'isRemote') {
            $query->andWhere(['longitude' => null])->andWhere(['latitude' => null]);
        }

        if (isset($filterResult['period'])) {
            $date = new DateTime();
            $dateCurrent = new DateTime('now');
            $date->sub(new DateInterval("P" . $filterResult['period'] . "D"));
            $query->andWhere(['>=', 'dt_add', $date->format('Y-m-d')]);
            $query->andWhere(['<=', 'dt_add', $dateCurrent->format('Y-m-d')]);
        }

        if (!empty($filterResult['title']) and isset($filterResult['title'])) {
            $query->andWhere(['name' => $filterResult['title']]);
        }
    }
}

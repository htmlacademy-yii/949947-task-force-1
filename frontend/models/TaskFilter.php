<?php

namespace frontend\models;

use DateInterval;
use DateTime;
use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;

class TaskFilter extends Model
{

    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 7;
    const PERIOD_MONTH = 30;

    public $categories;
    public $withoutExecutor;
    public $isRemote;
    public $period;
    public $title;

    /**
     * @return array
     */
    public static function AttributeLabel(): array
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
    public function rules(): array
    {
        return [
            [['categories', 'withoutExecutor', 'isRemote', 'period', 'title'], 'safe']
        ];
    }

    /**
     * список периодов времени
     *
     * @return array
     */
    public static function getPeriodList(): array
    {
        return [
            self::PERIOD_DAY => 'День',
            self::PERIOD_WEEK => 'Неделя',
            self::PERIOD_MONTH => 'Месяц',
        ];
    }

    /**
     * фильтрует задания
     *
     * @return array
     * @throws \Exception
     */
    public function tasksFilter(): array
    {
        $query = TaskInfo::find()->joinwith(Categories::tableName());
        if ($this->categories) {
            foreach ($this->categories as $categories) {
                $query->orWhere(['IN', 'categories.id', $categories]);
            }
        }
        if ($this->withoutExecutor) {
            $query->andWhere(['executor_id' => null]);
        }

        if ($this->isRemote) {
            $query->andWhere(['longitude' => null])->andWhere(['latitude' => null]);
        }

        if ($this->period) {
            $date = new DateTime();
            $dateCurrent = new DateTime('now');
            $date->sub(new DateInterval("P" . $this->period . "D"));
            $query->andWhere(['>=', 'dt_add', $date->format('Y-m-d')]);
            $query->andWhere(['<=', 'dt_add', $dateCurrent->format('Y-m-d')]);
        }

        if ($this->title) {
            $query->andWhere(['name' => $this->title]);
        }
        return $query->all();
    }
}

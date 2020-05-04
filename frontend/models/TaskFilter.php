<?php

namespace frontend\models;

use DateInterval;
use DateTime;
use Yii;
use yii\base\Model;
use yii\db\ActiveQuery;
use yii\db\Expression;

class TaskFilter extends Model
{

    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 7;
    const PERIOD_MONTH = 30;

    public $category;
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
                'category' => 'категории',
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
            [['category', 'withoutExecutor', 'isRemote', 'period', 'title'], 'safe']
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
     * @return ActiveQuery
     * @throws \Exception
     */
    public function tasksFilter(): ActiveQuery
    {
        $query = TaskInfo::find()->joinWith('category');
        if ($this->category) {
            foreach ($this->category as $category) {
                $query->orWhere(['IN', 'categories.id', $category]);
            }
        }
        if ($this->withoutExecutor) {
            $query->andWhere(['executor_id' => null]);
        }

        if ($this->isRemote) {
            $query->andWhere(['longitude' => null])->andWhere(['latitude' => null]);
        }

        if ($this->period) {
            $query->andWhere(['>=', 'dt_add', new Expression("NOW()-INTERVAL {$this->period} DAY")]);
        }

        if ($this->title) {
            $query->andWhere(['like', 'name', $this->title]);
        }

        return $query->orderBy(['dt_add' => SORT_DESC])->andWhere(['status' => Task::STATUS_NEW]);
    }
}

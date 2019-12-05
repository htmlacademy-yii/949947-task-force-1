<?php

declare(strict_types=1);

namespace frontend\helpers;

use frontend\components\action\CancelAction;
use frontend\components\action\FailAction;
use frontend\components\action\FinishAction;
use frontend\components\action\RespondAction;

class AvailableActions
{

    const ACTION_RESPOND = RespondAction::class;
    const ACTION_FAIL = FailAction::class;
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_FINISH = FinishAction::class;

    /**
     * Возвращает список действий
     *
     * @return array
     */
    public function getActionList(): array
    {
        return [
            self::ACTION_RESPOND,
            self::ACTION_FAIL,
            self::ACTION_CANCEL,
            self::ACTION_FINISH
        ];
    }

    /**
     *
     *определять список доступных действий, который зависит от: текущего статуса задания,роли пользователя,id пользователя.
     *
     * @param int $idInitiator
     * @return array
     */
    public function availableActions(int $idInitiator): array
    {
        $actionCurrent = array();
        foreach ($this->getActionList() as $action) {
            if ($action::checkRightsUsers($idInitiator, $this)) {
                $actionCurrent[] = $action::getInsideStaticName();
            }
        }

        return $actionCurrent;
    }

}
<?php

declare(strict_types=1);

namespace frontend\components\action;

use frontend\models\Task;

class RespondAction extends AbstractAction
{
    const INSIDE_NAME = 'respond';

    /**
     * проверяет права пользователя
     *
     * @param int $userId
     * @param Task $Task
     * @return bool
     */
    static function checkRightsUsers(int $userId, Task $Task): bool
    {
        return $Task->getCurrentStatus() === Task::STATUS_NEW && $userId === $Task->getIdExecutor();
    }
}

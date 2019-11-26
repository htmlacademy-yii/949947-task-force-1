<?php

declare(strict_types=1);

namespace Academy\classes\action;

use Academy\classes\Task;

class StartAction extends AbstractAction
{
    const INSIDE_NAME = 'started';

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

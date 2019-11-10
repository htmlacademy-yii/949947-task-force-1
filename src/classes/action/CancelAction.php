<?php

namespace Academy\classes\action;

use Academy\classes\Task;

class CancelAction extends AbstractAction
{
    const INSIDE_NAME = 'canceled';

    /**
     * проверяет права пользователя
     *
     * @param int $userId
     * @param Task $Task
     * @return bool
     */
    static function checkRightsUsers(int $userId, Task $Task): bool
    {
        return $Task->getCurrentStatus() === $Task::ACTION_NEW && $userId === $Task->getIdCustomer();
    }
}

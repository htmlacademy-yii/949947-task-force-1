<?php

namespace Academy\classes\action;

use Academy\classes\Task;

class NewAction extends AbstractAction
{
    const INSIDE_NAME = 'new';

    /**
     * проверяет права пользователя
     *
     * @param int $userId
     * @param Task $Task
     * @return bool
     */
    static function checkRightsUsers(int $userId, Task $Task): bool
    {
        if ($userId === $Task->getIdCustomer() and $Task->getCurrentStatus() === null) {
            return true;
        } else {
            return false;
        }
    }
}

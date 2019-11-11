<?php

declare(strict_types=1);

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
        return $userId === $Task->getIdCustomer() && $Task->getCurrentStatus() === null;
    }
}

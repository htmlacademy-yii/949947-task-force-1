<?php

declare(strict_types=1);
namespace Academy\classes\action;

use Academy\classes\Task;

abstract class AbstractAction
{
    const INSIDE_NAME = '';

    /**
     * Метод возвращает имя класса
     *
     * @return string
     */
    static public function getName(): string
    {
        return static::class;
    }

    /**
     * Метод возвращает внутренее имя
     *
     * @return string
     */
    public static function getInsideStaticName(): string
    {
        return static::INSIDE_NAME;
    }

    /**
     * проверяет права пользователя
     *
     * @param int $userId
     * @param Task $Task
     * @return bool
     */
    abstract public static function checkRightsUsers(int $userId, Task $Task): bool;
}


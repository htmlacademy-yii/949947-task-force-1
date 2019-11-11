<?php

declare(strict_types=1);
namespace Academy\classes;

use Academy\classes\action\CancelAction;
use Academy\classes\action\NewAction;
use Academy\classes\action\FailAction;
use Academy\classes\action\StartAction;
use Academy\classes\action\FinishAction;
use Academy\classes\exception\ClassNameException;
use Academy\classes\exception\ActionException;
use Academy\classes\exception\FunctionNameException;
use Exception;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';

    const ACTION_NEW = NewAction::class;
    const ACTION_FAIL = FailAction::class;
    const ACTION_CANCEL = CancelAction::class;
    const ACTION_START = StartAction::class;
    const ACTION_FINISH = FinishAction::class;

    const ROLE_EXECUTOR = 'executor';
    const ROLE_CUSTOMER = 'customer';

    private $idExecutor;
    private $idCustomer;
    private $status;
    private $date;

    private const RELATIONS = [
        self::ACTION_NEW => self::STATUS_NEW,
        self::ACTION_START => self::STATUS_PROCESSING,
        self::ACTION_FINISH => self::STATUS_FINISHED,
        self::ACTION_FAIL => self::STATUS_FAILED,
        self::ACTION_CANCEL => self::STATUS_CANCELED,
    ];

    public function __construct(int $idCustomer, int $idExecutor)
    {
        $this->idCustomer = $idCustomer;
        $this->idExecutor = $idExecutor;
    }

    /**
     * Возвращает статус в зависимости от действия
     *
     * @param string $action
     *
     * @return string|null
     * @throws ActionException
     */

    public function getNextStatus(string $action): ?string
    {
        if (in_array($action, self::RELATIONS)) {
            return self::RELATIONS[$action] ?? null;
        } else {
            throw new ActionException('Такого действия нет!');
        }
    }

    /**
     * Возвращает список статусов
     *
     * @return array
     */
    public function getStatusList(): array
    {
        return [
            self::STATUS_NEW,
            self::STATUS_PROCESSING,
            self::STATUS_CANCELED,
            self::STATUS_FINISHED,
            self::STATUS_FAILED
        ];
    }

    /**
     * Возвращает список действий
     *
     * @return array
     */
    public function getActionList(): array
    {
        return [
            self::ACTION_NEW,
            self::ACTION_FAIL,
            self::ACTION_CANCEL,
            self::ACTION_START,
            self::ACTION_FINISH
        ];
    }

    /**
     * Возвращает id заказчика
     *
     * @return int
     */
    public function getIdCustomer(): int
    {
        return $this->idCustomer;
    }

    /**
     * Возвращает id исполнителя
     *
     * @return int
     */
    public function getIdExecutor(): ?int
    {
        return $this->idExecutor;
    }

    /**
     * Возвращает текущий статус
     *
     * @return string|null
     */
    public function getCurrentStatus(): ?string
    {
        return $this->status;
    }

    /**
     *
     *определять список доступных действий, который зависит от: текущего статуса задания,роли пользователя,id пользователя.
     *
     * @param int $idInitiator
     * @return array
     * @throws ClassNameException
     * @throws FunctionNameException
     */
    public function availableActions(int $idInitiator): array
    {
        $actionCurrent = array();
        foreach ($this->getActionList() as $action) {
            if (!class_exists($action)) {
                throw new ClassNameException('Такой класс не существует!');
            }
            if (!method_exists($action, 'checkRightsUsers')) {
                throw new FunctionNameException('Такая функция не существует');
            }
            if (!method_exists($action, 'getInsideStaticName')) {
                throw new FunctionNameException('Такая функция не существует');
            }
            if ($action::checkRightsUsers($idInitiator, $this)) {
                $actionCurrent[] = $action::getInsideStaticName();
            }
        }

        return $actionCurrent;
    }
}

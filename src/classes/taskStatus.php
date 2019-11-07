<?php

namespace Academy\classes;

use Exception;

class taskStatus
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';

    const ACTION_NEW = 'new';
    const ACTION_FAIL = 'fail';
    const ACTION_CANCEL = 'cancel';
    const ACTION_START = 'start';
    const ACTION_FINISH = "finish";

    const ROLE_EXECUTOR = 'executor';
    const ROLE_CUSTOMER = 'customer';

    private $idExecutor;
    private $idCustomer;
    private $status = self::STATUS_NEW;
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
     */

    public function getNextStatus(string $action): ?string
    {
        return self::RELATIONS[$action] ?? null;
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
     *
     *определять список доступных действий, который зависит от: текущего статуса задания,роли пользователя,id пользователя.
     *
     * @param int $idInitiator
     */
    public function availableActions(int $idInitiator)
    {

    }
}

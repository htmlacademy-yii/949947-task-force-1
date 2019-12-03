<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\components\action\CancelAction;
use frontend\components\action\FailAction;
use frontend\components\action\RespondAction;
use frontend\components\action\FinishAction;
use frontend\exception\InvalidActionException;
use Exception;
use frontend\helpers\AvailableActions;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESSING = 'processing';
    const STATUS_CANCELED = 'canceled';
    const STATUS_FINISHED = 'finished';
    const STATUS_FAILED = 'failed';

    const ROLE_EXECUTOR = 'executor';
    const ROLE_CUSTOMER = 'customer';

    private $idExecutor;
    private $idCustomer;
    private $status;
    private $date;

    private const RELATIONS = [
        AvailableActions::ACTION_RESPOND => self::STATUS_PROCESSING,
        AvailableActions::ACTION_FINISH => self::STATUS_FINISHED,
        AvailableActions::ACTION_FAIL => self::STATUS_FAILED,
        AvailableActions::ACTION_CANCEL => self::STATUS_CANCELED,
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
     * @throws InvalidActionException
     */

    public function getNextStatus(string $action): ?string
    {
        if (!array_keys(self::RELATIONS, $action)) {
            throw new InvalidActionException('Такого действия нет!');
        }

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
}

<?php
use Academy\classes\Task;
require_once 'vendor/autoload.php';

$customer_id = 5;
$exception_id = 6;

$initiator_id = 5;
$task = new Task($customer_id,$exception_id);

try {
$task->start($initiator_id);
} catch (Exception $exception) {
echo $exception->getMessage();
}
try {
$task->fail($initiator_id);
} catch (Exception $exception) {
echo $exception->getMessage();
}
//try {
//$task->finish($initiator_id);
//} catch (Exception $exception) {
//echo $exception->getMessage();
//}
//try {
//$task->cancel($initiator_id);
//} catch (Exception $exception) {
//echo $exception->getMessage();
//}

//$nextStatus = $task->getNextStatus(Task::ACTION_NEW);
//var_dump(assert($nextStatus === Task::STATUS_NEW, 'При создании задачи возвращается корректный статус'));
//
//$nextStatus = $task->getNextStatus(Task::ACTION_FAIL);
//var_dump(assert($nextStatus === Task::STATUS_FAILED, 'При отказе от задачи возвращается корректный статус'));
//
//$nextStatus = $task->getNextStatus(Task::ACTION_CANCEL);
//var_dump(assert($nextStatus === Task::STATUS_CANCELED, 'При отмене задачи возвращается корректный статус'));
//
//$nextStatus = $task->getNextStatus(Task::ACTION_START);
//var_dump(assert($nextStatus === Task::STATUS_PROCESSING, 'При старте задачи возвращается корректный статус'));
//
//$nextStatus = $task->getNextStatus(Task::ACTION_FINISH);
//var_dump(assert($nextStatus === Task::STATUS_FINISHED, 'При завершении задачи возвращается корректный статус'));

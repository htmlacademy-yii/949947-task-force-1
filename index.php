<?php

declare(strict_types=1);

use Academy\classes\Task;
use Academy\classes\action\CancelAction;
use Academy\classes\action\NewAction;
use Academy\classes\action\FailAction;
use Academy\classes\action\StartAction;
use Academy\classes\action\FinishAction;
use Academy\classes\exception\InvalidActionException;

require_once './vendor/autoload.php';

$idCustomer = 1;
$idException = 2;

$task = new Task($idCustomer, $idException);


//$new = new FinishAction();
//var_dump($new->getInsideStaticName());
//var_dump($task->availableActions(1));
try {
    var_dump($task->getNextStatus('findfished'));

} catch (InvalidActionException $e) {

    echo $e;
}

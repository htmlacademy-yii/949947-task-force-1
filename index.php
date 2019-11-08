<?php

use Academy\classes\Task;

require_once './vendor/autoload.php';

$idCustomer = 1;
$idException = 2;
$idInitiator = 1;

$task = new Task($idCustomer, $idException);

var_dump($task->getNextStatus('cancel'));

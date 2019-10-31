<?php

use Academy\classes\Task;

require_once './vendor/autoload.php';

$idCustomer = 5;
$idException = 6;
$idInitiator = 5;

$task = new Task($idCustomer, $idException);

var_dump($task->getNextStatus('finish'));

//$task->getStatusList();

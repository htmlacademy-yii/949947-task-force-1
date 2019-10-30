<?php

use Academy\classes\Task;

require_once 'vendor/autoload.php';

$idCustomer = 5;
$idException = 6;

$initiator_id = 5;
$task = new Task($idCustomer, $idException);

var_dump($task->getNextStatus());

$task->getStatusList();
//var_dump($task -> getStatusList());
//var_dump($task -> getActionList());
